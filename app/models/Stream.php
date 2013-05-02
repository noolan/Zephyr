<?php

class Stream extends Eloquent {

	protected $table = 'streams';
	protected $guarded = array('id');
	public $timestamps = false;

	public function revisions() {
		return $this->morphMany('Revision', 'revised');
	}

	public function items() {
		return $this->hasMany('Item');
	}

	public static function add($parameters) {
		$stream = Stream::create(array());

		foreach($parameters['revisions'] as $language => $revision) {
			$stream->revise(array(
				'language_id' => Language::getId($language),
				'name'        => $revision['name'],
				'slug'        => $revision['slug'],
				'item_name'   => $revision['item_name'],
				'content'     => $revision['content']
			));
		}
	}

	public function revise($parameters) {
		$this->revisions()->save(new Revision($parameters));
	}

	public function addItem($parameters) {
		$item = Item::create(array(
			'stream_id' => $this->id,
		));

		foreach($parameters['revisions'] as $language => $revision) {
			$item->revise(array(
				'language_id' => Language::getId($language),
				'name'        => $revision['name'],
				'content'     => $revision['content']
			));
		}
	}

}