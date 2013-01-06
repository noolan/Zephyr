<?php

class User extends Eloquent {
	public static $table = 'users';
	public static $timestamps = false;

	public function set_password($password) {
		$this->set_attribute('hashed_password', Hash::make($password));
	}

	public static function create_schema() {
		if (Schema::table_exists(static::$table))
			Schema::drop(static::$table);

		Schema::create(static::$table, function($table) {
			$table->engine = 'MyISAM';
			$table->increments('id');

			$table->string('name');
			$table->string('email')->index();
			$table->string('hashed_password', 60);
			
		});
	}
}