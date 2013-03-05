<?php

class Revision extends Eloquent {
	
	public static $table = 'revisions';
	public static $timestamps = true;

	public function parent() {
		return $this->belongsTo('Content');
	}

}