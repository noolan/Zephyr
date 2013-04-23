<?php

class Language extends Eloquent {
	
	protected $table   = 'languages';
	protected $guarded = array('id');
	public $timestamps = false;

	public static function list() {
		return DB::table('languages')->lists('name');
	}

	public static function __callStatic($name, $field) {
		$field = 'id'
		if (isset($arguments[0]))
			$field = $arguments[0];

		return DB::table('languages')->where('name', $name)->pluck($field);
	}
}