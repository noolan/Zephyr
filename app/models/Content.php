<?php

class Content extends Eloquent {

	public static $table = 'content';
	public static $timestamps = true;

	const PAGE = 1;
	const POST = 2;

	public static $types = array(
		1 => 'PAGE',
		2 => 'POST'
	);

	public function revisions() {
		return $this->hasMany('Revision');
	}

	public function tags() {
		return $this->belongsToMany('Tas');
	}

	public function content()

	public static function create_schema() {
		Schema::dropIfExists(static::$table);

		Schema::create(static::$table, function($table) {
			$table->engine = 'MyISAM';
			$table->increments('id');

			$table->string('slug')->index();
			$table->string('title')->fulltext();
			$table->integer('tag_id')->unsigned()->index();
			$table->timestamps();
			
		});
	}
}