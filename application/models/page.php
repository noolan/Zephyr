<?php

class Page extends Eloquent {
	public static $table = 'pages';

	public function content() {
		return $this->has_many('Content');
	}

	public function tag() {
		return $this->belongs_to('Tag');
	}

	public function posts() {
		return $this->tag()->posts()->get();
	}

	public function get_text() {
		return $this->content()->order_by('created_at', 'desc')->first()->text;
	}

	public function set_content($content) {
		$this->contents()->insert(new Content(array('text' => $content)));
	}

	public function set_slug($slug) {
		$this->set_attribute('slug', Str::slug($slug));
	}

	public static function home() {
		return Page::order_by('order', 'asc')->first();
	}

	public static function links() {
		return Page::order_by('order', 'asc')->get(array('slug', 'title'));
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