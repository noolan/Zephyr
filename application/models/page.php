<?php

class Page extends Eloquent {
	public static $table = 'pages';

	public function content() {
		return $this->has_many('Content');
	}

	public function posts() {
		//return
	}

	public function get_content() {
		return $this->content()->order_by('created_at', 'desc')->first();
	}

	public function set_content($content) {
		$this->content()->insert(new Content(array('text' => $content)));
	}

	public static function create_schema() {
		if (Schema::table_exists(static::$table))
			Schema::drop(static::$table);

		Schema::create(static::$table, function($table) {
			$table->engine = 'MyISAM';
			$table->increments('id');

			$table->integer('tag_id')->unsigned()->nullable()->index();
			$table->string('slug');
			$table->string('title')->fulltext();
			$table->integer('order')->default(1);
			$table->timestamps();
		});
	}
}