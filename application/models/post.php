<?php

class Post extends Eloquent {
	public static $table = 'posts';

	public function tags() {
		return $this->has_many_and_belongs_to('Tag', 'post_tags');
	}

	public static function create_schema() {
		if (Schema::table_exists(static::$table))
			Schema::drop(static::$table);

		Schema::create(static::$table, function($table) {
			$table->engine = 'MyISAM';
			$table->increments('id');

			$table->string('title')->fulltext();
			$table->text('text')->fulltext();
			$table->timestamps();
		});
	}
}