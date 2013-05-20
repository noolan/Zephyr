<?php

class Category extends Eloquent {

	protected $table   = 'categories';
	protected $guarded = array('id');
	public $timestamps = false;

	private $_currentRevision = null;

	public function revisions() {
		return $this->morphMany('Revision', 'revised')->orderBy('created_at', 'DESC');
	}
	public function items() {
		return $this->hasMany('Item');
	}
	public function parent() {
		return $this->belongsTo('Category', 'parent_id');
	}
	public function children() {
		return $this->hasMany('Category', 'parent_id');
	}

	// accessors
	public function currentRevision() {
		if (is_null($this->_currentRevision))
			$this->_currentRevision = $this->revisions()->categories()->first();
		return $this->_currentRevision;
	}
	public function getNameAttribute() {
		return $this->currentRevision()->name;
	}
	public function getSlugAttribute() {
		return $this->currentRevision()->slug;
	}

	public static function findBySlug($slug) {
		return Revision::categories()->where('slug', $slug)->first()->revised;
	}

	public function itemsByCollection() {
		$items = array();
		foreach ($this->items()->with('Collection')->orderBy('collection_id')->get() as $item) {
			$items[$item->collection->item_name][$item->id] = $item;
		}
		return $items;
	}

	public static function add($parameters) {
		$category = Category::create(array());

		foreach($parameters['revisions'] as $language => $revision) {
			$category->revise(array(
				'language_id' => Language::getId($language),
				'name'        => $revision['name'],
				'slug'        => $revision['slug']
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
				'slug'        => $revision['slug']
			));
		}

		return $sub_category;
	}

	public function revise($parameters) {
		$this->revisions()->save(new Revision($parameters));
	}

	public static function crumble($slug, $case = 'ucwords') {
		$crumbs = array();
		$breadcrumb = '';
		foreach (explode('/', $slug) as $segment) {
			$crumbs[$case(str_replace(array('-', '_'), ' ', $segment))] = ltrim($breadcrumb .= '/'.$segment, '/');
		}
		return $crumbs;
	}

}