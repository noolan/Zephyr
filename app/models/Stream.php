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

}