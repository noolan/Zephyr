<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeRevisionsTablePolymorphic extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('revisions', function(Blueprint $table)
		{
			$table->dropIndex('revisions_page_id_index');
			$table->dropColumn('page_id');

			$table->dropIndex('revisions_stream_id_index');
			$table->dropColumn('stream_id');

			$table->dropIndex('revisions_item_id_index');
			$table->dropColumn('item_id');

			$table->integer('revised_id')->unsigned()->nullable()->index();
			$table->string('revised_type');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('revisions', function(Blueprint $table)
		{
			$table->dropIndex('revisions_revised_id_index');
			$table->dropColumn('revised_id');

			$table->dropColumn('revised_type');

			$table->integer('page_id')->unsigned()->nullable()->index();
			$table->integer('stream_id')->unsigned()->nullable()->index();
			$table->integer('item_id')->unsigned()->nullable()->index();
		});
	}

}