<?php

class Item extends Eloquent {

	protected $table = 'items';
	protected $guarded = array( 'id' );

	public $timestamps = true;

	public function stream() {
		return $this->belongsTo('Stream');
	}

	public function setSlug($title) {
		$this->attributes['slug'] = Str::slug($title);
	}

	public static function create_schema() {
		Schema::dropIfExists(static::$table);

		Schema::create(static::$table, function($table) {
			$table->engine = 'MyISAM';
			$table->increments('id');
			$table->integer('stream_id')->unsigned()->nullable();

			$table->string('title')->fulltext();
			$table->string('item_name');
			$table->timestamps();

		});
	}
}