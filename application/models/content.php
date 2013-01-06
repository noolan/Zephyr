<?php

class Content extends Eloquent {
	public static $table = 'content';

	public static function create_schema() {
		if (Schema::table_exists(static::$table))
			Schema::drop(static::$table);

		Schema::create(static::$table, function($table) {
			$table->engine = 'MyISAM';
			$table->increments('id');

			$table->integer('page_id')->unsigned()->index();
			$table->text('text')->fulltext();
			$table->timestamps();
		});
	}
}