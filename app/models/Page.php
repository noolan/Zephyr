<?php

class Content extends Eloquent {

	protected $table = 'pages';
	protected $guarded = array( 'id' );

	public $timestamps = false;

	public function setSlug($title) {
		$this->attributes['slug'] = Str::slug($title);
	}

	public static function create_schema() {
		Schema::dropIfExists(static::$table);

		Schema::create(static::$table, function($table) {
			$table->engine = 'MyISAM';
			$table->increments('id');

			$table->string('slug')->index();
			$table->string('title')->fulltext();
			$table->string('item_name');
			$table->integer('stream_id')->unsigned()->nullable();
			$table->integer('order')->default(0);
		});
	}
}