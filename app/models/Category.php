<?php

class Category extends Eloquent {

	protected $table   = 'categories';
	protected $guarded = array('id');
	public $timestamps = false;

	private $_currentRevision = null;

	public function revisions() {
		return $this->morphMany('Revision', 'revised');
	}
	public function items() {
		return $this->hasMany('Item');
	}
	public function parent() {
		return $this->belongsTo('Collection', 'parent_id');
	}

	// accessors
	public function currentRevision() {
		if (is_null($this->_currentRevision))
			$this->_currentRevision = $this->revisions()->collection()->first();
		return $this->_currentRevision;
	}
	public function getNameAttribute() {
		return $this->currentRevision()->name;
	}
	public function getSlugAttribute() {
		return $this->currentRevision()->slug;
	}

	public static function findBySlug($slugs) {
		$segments = explode('/', $slugs);
		$category_id = 0;
		foreach($segments as $key => $slug) {
			if ($key < (count($segments) - 1))
				$category_id = Revision::categories()->where('parent_id', $category_id)
			                                       ->where('slug', $slug)
		                                         ->first()->category_id;
		  else
		  	$revision = Revision::categories()->where('parent_id', $category_id)
			                                    ->where('slug', $slug)
		                                      ->first();
		}

		if (!$revision)
			App::abort(404, Lang::get('messages.404'));

		return $revision->revised;
	}

	public static function add($parameters) {
		$category = Category::create(array());

		foreach($parameters['revisions'] as $language => $revision) {
			$category->revise(array(
				'language_id' => Language::getId($language),
				'name'        => $revision['name'],
				'slug'        => $revision['item_name']
			));
		}

		return $category;
	}

	public function addSubCategory($parameters) {
		$sub_category = Category::create(array('parent_id' => $this->id));

		foreach($parameters['revisions'] as $language => $revision) {
			$sub_category->revise(array(
				'language_id' => Language::getId($language),
				'name'        => $revision['name'],
				'slug'        => $revision['content']
			));
		}

		return $sub_category;
	}

	public function revise($parameters) {
		$this->revisions()->save(new Revision($parameters));
	}


}