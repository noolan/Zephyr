<?php

class Collection extends Eloquent {

	protected $table   = 'collections';
	protected $guarded = array('id');
	public $timestamps = false;

	private $_currentRevision = null;

	const BLOG     = 1;
	const DOCUMENT = 2;
	const EVENT    = 3;
	const NOTICE   = 4;
	const PICTURE  = 5;

	public static $types = array(
		1 => 'BLOG',
		2 => 'DOCUMENT',
		3 => 'EVENT',
		4 => 'NOTICE',
		5 => 'PICTURE'
	);

	public static $colors = array(
	  1 => 'primary',
	  2 => 'info',
	  3 => 'success',
	  4 => 'danger',
	  5 => 'warning'
	);
	public function color() {
		return self::$colors[$this->type];
	}

	const SORT_CREATED_ASC  = 'created_at ASC';
	const SORT_CREATED_DESC = 'created_at DESC';
	const SORT_NAME_ASC     = 'name ASC';
	const SORT_NAME_DESC    = 'name DESC';
	const SORT_START_ASC    = 'start ASC';
	const SORT_START_DESC   = 'start DESC';

	public static $item_sorts = array(
	  'SORT_CREATED_ASC',
	  'SORT_CREATED_DESC',
	  'SORT_NAME_ASC',
	  'SORT_NAME_DESC',
	  'SORT_START_ASC',
	  'SORT_START_DESC'
	);

	// relations
	public function revisions() {
		return $this->morphMany('Revision', 'revised');
	}
	public function items() {
		return $this->hasMany('Item')->orderBy(DB::raw($this->item_sort));
	}
	

	// accessors
	public function currentRevision() {
		if (is_null($this->_currentRevision))
			$this->_currentRevision = $this->revisions()->collections()->first();
		return $this->_currentRevision;
	}
	public function getItemNameAttribute() {
		return $this->currentRevision()->item_name;
	}

	// crud
	public static function add($parameters) {
		$collection = Collection::create(array(
			'item_sort'   => $parameters['item_sort'],
			'type'        => $parameters['type']
		));

		foreach($parameters['revisions'] as $language => $revision) {
			$collection->revise(array(
				'language_id' => Language::getId($language),
				'item_name'   => $revision['item_name']
			));
		}

		return $collection;
	}

	public function revise($parameters) {
		$this->revisions()->save(new Revision($parameters));
	}

	public function addItem($parameters) {
		$category = Category::find($parameters['category']);
		$item = Item::create(array(
			'collection_id' => $this->id,
			'category_id' => $category->id
		));

		foreach($parameters['revisions'] as $language => $revision) {
			$language_id = Language::getId($language);
			$slug = null;
			if (ThisOr::false('slug', $revision))
				$slug = $category->revisions()->where('language_id', $language_id)->first()->slug.'/'.$revision['slug'];

			$item->revise(array(
				'language_id' => $language_id,
				'name'        => $revision['name'],
				'slug'        => $slug,
				'filename'    => ThisOr::null('filename', $revision),
				'start'       => ThisOr::null('start', $revision),
				'end'         => ThisOr::null('end', $revision),
				'content'     => ThisOr::null('content', $revision)
			));
		}
	}

}