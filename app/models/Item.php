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

	public function update($parameters) {
		$this->revisions()->insert(new Revision($parameters));
	}


}