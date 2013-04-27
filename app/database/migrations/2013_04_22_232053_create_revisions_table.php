<?php

use Illuminate\Database\Migrations\Migration;

class CreateRevisionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('revisions', function($table)
		{
			$table->increments('id');
			$table->integer('language_id')->unsigned()->index();

			$table->integer('page_id')->unsigned()->nullable()->index();
			$table->integer('stream_id')->unsigned()->nullable()->index();
			$table->integer('item_id')->unsigned()->nullable()->index();

			$table->string('name')->fulltext();
			$table->text('content')->fulltext();

			$table->string('slug')->nullable()->index();
			$table->string('item_name')->nullable();

			$table->timestamps();
			
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('revisions');
	}

}