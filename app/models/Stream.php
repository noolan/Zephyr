<?php

class Stream extends Eloquent {

	protected $table = 'streams';
	protected $guarded = array( 'id' );
	
	public $timestamps = false;

	public function items() {
		return $this->hasMany('Item');
	}

	public static function create_schema() {
		Schema::dropIfExists(static::$table);

		Schema::create(static::$table, function($table) {
			$table->engine = 'MyISAM';
			$table->increments('id');

			$table->string('slug')->index();
			$table->string('title')->fulltext();
			$table->text('content')->fulltext();
		});
	}
}