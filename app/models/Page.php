<?php

class Page extends Eloquent {

	protected $table = 'pages';
	protected $guarded = array('id');
	public $timestamps = false;

	private $_currentRevision = null;

	public function revisions() {
		return $this->morphMany('Revision', 'revised');
	}

	public static function links() {
		return DB::table('pages')->join('revisions', 'pages.id', '=', 'revisions.revised_id')
														 ->whereRaw('revisions.revised_type = "Page"')
														 ->whereRaw('revisions.language_id = '. Language::current()->id)
		                         ->whereExists(function($query) {
			$query->select(DB::raw(1))
						->from('revisions')
						->whereRaw('revisions.revised_id = pages.id')
						->whereRaw('revisions.revised_type = "Page"')
						->whereRaw('revisions.language_id = ' . Language::current()->id);
		})->get();

	}

	public static function first() {
		return Page::with('revisions')->orderBy('order', 'ASC')->first();
	}

	public static function findBySlug($slug) {
		$revision = Revision::pages()->where('slug', $slug)
		                             ->first();
		if (!$revision)
			App::abort(404, Lang::get('messages.404'));

		return $revision->revised;
	}

	public function currentRevision() {
		if (is_null($this->_currentRevision))
			$this->_currentRevision = $this->revisions()->where('language_id', Language::current()->id)->orderBy('created_at', 'DESC')->first();
		return $this->_currentRevision;
	}

	public function getNameAttribute() {
		return $this->currentRevision()->name;
	}

	public function getSlugAttribute() {
		return $this->currentRevision()->slug;
	}

	public function getContentAttribute() {
		return $this->currentRevision()->content;
	}

	public static function add($parameters) {
		$page = Page::create(array(
			'order' => $parameters['order']
		));
		//var_dump($parameters); die();
		foreach($parameters['revisions'] as $language => $revision) {
			$page->revise(array(
				'language_id' => Language::$language(),
				'name'        => $revision['name'],
				'slug'        => $revision['slug'],
				'content'     => $revision['content']
			));
		}
	}

	public function revise($parameters) {
		$this->revisions()->save(new Revision($parameters));
	}

}