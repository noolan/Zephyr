<?php

class Setting extends Eloquent {

	protected $table = 'settings';
	protected $guarded = array('id');
	public $timestamps = true;

	public static function __callStatic($key, $args) {

		if (isset($args[0])) {
			if (isset($args[1]))
				return self::create(array('key' => $key, 'value' => $args[0], 'language_id' => $args[1]));
			else
				return self::create(array('key' => $key, 'value' => $args[0]));
		} else
			return DB::table('settings')->where('key', $key)
			                            ->where(function($query) {
			                            	$query->whereNull('language_id')
			                            	      ->orWhere('language_id', Language::current()->id);
			                            })
		                              ->orderBy('created_at')
		                              ->orderBy('id', 'DESC')
		                              ->pluck('value');
	}


}