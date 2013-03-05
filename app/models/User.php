<?php

use Illuminate\Auth\UserInterface;

class User extends Eloquent implements UserInterface {

	public static $table = 'users';
	public static $hidden = array('password');

	public function set_password($password) {
		$this->set_attribute('hashed_password', Hash::make($password));
	}

	public function getAuthIdentifier() {
		return $this->getKey();
	}

	public function getAuthPassword() {
		return $this->hashed_password;
	}

	public static function create_schema() {
		Schema::dropIfExists(static::$table);

		Schema::create(static::$table, function($table) {
			$table->engine = 'MyISAM';
			$table->increments('id');

			$table->string('name');
			$table->string('email')->index();
			$table->string('hashed_password', 60);
			$table->timestamps();
			
		});
	}

}