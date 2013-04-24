<?php

class Stream extends Eloquent {

	protected $table = 'streams';
	protected $guarded = array('id');
	public $timestamps = false;

	public function revisions() {
		return $this->hasMany('Revision');
	}

	public function items() {
		return $this->hasMany('Item');
	}

	public static function add($parameters) {
		$stream = Stream::create());

		foreach($parameters->revisions as $language => $revision) {
			$item->update(array(
				'language_id' => Language::$language(),
				'name'        => $revision['name'],
				'slug'        => $revision['slug'],
				'item_name'   => $revision['item_name'],
				'content'     => $revision['content']
			));
		}
	}

	public function update($parameters) {
		$this->revisions()->insert(new Revision($parameters));
	}

	public function addItem($parameters) {
		$item = Item::create(array(
			'stream_id' => $this->id,
		));

		foreach($parameters->revisions as $language => $revision) {
			$item->update(array(
				'language_id' => Language::$language(),
				'name'        => $revision['name'],
				'content'     => $revision['content']
			));
		}
	}

}