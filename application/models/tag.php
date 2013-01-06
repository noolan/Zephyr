<?php

class Tag extends Eloquent {
	public static $table = 'tags';

	public function posts() {
		return $this->has_many_and_belongs_to('Post', 'post_tags');
	}

	public static function create_schema() {
		if (Schema::table_exists(static::$table))
			Schema::drop(static::$table);

		Schema::create(static::$table, function($table) {
			$table->engine = 'MyISAM';
			$table->increments('id');

			$table->string('name');
			$table->timestamps();
		});
	}
}