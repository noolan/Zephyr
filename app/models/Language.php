<?php

class Language extends Eloquent {
	
	protected $table   = 'languages';
	protected $guarded = array('id');
	public $timestamps = false;
	private static $_current = null;

	public static function current() {
		if (is_null(self::$_current)) {
			if (strlen(Request::segment(1)) == 2)
				self::$_current = DB::table('languages')->where('abbreviation', Request::segment(1))->first();
			elseif (!(self::$_current = DB::table('languages')->where('default', 1)->first()))
				self::$_current = DB::table('languages')->first();

			App::setLocale(Request::segment(1));
		}

		return self::$_current;

	}

	public static function listAll() {
		return DB::table('languages')->lists('name');
	}

	public static function getId($language) {
		if (strlen($language) == 2)
			return (int)DB::table('languages')->where('abbreviation', $language)->pluck('id');
		else
			return (int)DB::table('languages')->where('name', $language)->pluck('id');
	}

	public function setDefaultAttribute($value) {
		DB::table('languages')->where('default', 1)
		                      ->update(array('default' => 0));
		if ($value) {
		  $this->default = true;
		  $this->save();
		} else {
			DB::table('languages')->update(array('default' => 1))->take(1);
		}
	}
}