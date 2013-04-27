<?php

class Item extends Eloquent {

	protected $table = 'items';
	protected $guarded = array('id');
	public $timestamps = true;

	public function revisions() {
		return $this->morphMany('Revision', 'revised');
	}

	public function stream() {
		return $this->belongsTo('Stream');
	}

	public function revise($parameters) {
		$this->revisions()->save(new Revision($parameters));
	}


}