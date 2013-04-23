<?php

class Item extends Eloquent {

	protected $table = 'items';
	protected $guarded = array('id');
	public $timestamps = true;

	public function revisions() {
		return $this->hasMany('Revision');
	}

	public function stream() {
		return $this->belongsTo('Stream');
	}

	public static function add($parameters) {
		$item = Item::create(array(
			'order' => $parameters['order']
		));
		foreach($parameters->revisions as $language => $revision) {
			$item->update(array(
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