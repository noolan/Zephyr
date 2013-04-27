<?php

class Page extends Eloquent {

	protected $table = 'pages';
	protected $guarded = array('id');
	public $timestamps = false;

	public function revisions() {
		return $this->morphMany('Revision', 'revised');
	}

	public static function links($language = 'english') {
		$language_id = Language::$language();

		return DB::table('pages')->whereExists(function($query) {
			$query->select(DB::raw(1))
						->from('revisions')
						->whereRaw('revisions.page_id = pages.id')
						->whereRaw('revisions.language_id = ' . $language_id);
		})->get();
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