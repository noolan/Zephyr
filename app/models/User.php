<?php

use Illuminate\Auth\UserInterface;

class User extends Eloquent implements UserInterface {

	protected $table = 'users';
	protected $hidden = array( 'password' );
	protected $guarded = array( 'id', 'password' );

	public $timestamps = false;

	public function setPassword($password) {
		$this->attributes['password'] = Hash::make($password);
	}

	public function getAuthIdentifier() {
		return $this->getKey();
	}

	public function getAuthPassword() {
		return $this->password;
	}

	public static function create_schema() {
		Schema::dropIfExists(static::$table);

		Schema::create(static::$table, function($table) {
			$table->engine = 'MyISAM';
			$table->increments('id');

			$table->string('name');
			$table->string('email')->index();
			$table->string('password', 60);
			
		});
	}

}