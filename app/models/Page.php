<?php

class Content extends Eloquent {

	protected $table = 'pages';
	protected $guarded = array('id');
	public $timestamps = false;

	public function revisions() {
		return $this->hasMany('Revision');
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
		foreach($parameters->revisions as $language => $revision) {
			$page->update(array(
				'language_id' => Language::$language(),
				'name'        => $revision['name'],
				'slug'        => $revision['slug'],
				'content'     => $revision['content']
			));
		}
	}

	public function update($parameters) {
		$this->revisions()->insert(new Revision($parameters));
	}

}