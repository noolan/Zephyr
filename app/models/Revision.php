<?php

class Revision extends Eloquent {
	
	protected $table = 'revisions';
	protected $guarded = array('id');
	public $timestamps = true;

	public function revised() {
		return $this->morphTo();
	}
}