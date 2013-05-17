<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToRevisionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('revisions', function(Blueprint $table)
		{
			$table->string('filename')->nullable()->index();
			$table->datetime('start')->nullable()->index();
			$table->datetime('end')->nullable()->index();
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
			$table->dropIndex('revisions_filename_index');
			$table->dropIndex('revisions_start_index');
			$table->dropIndex('revisions_end_index');

			$table->dropColumn('filename');
			$table->dropColumn('start');
			$table->dropColumn('end');
		});
	}

}