<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnFixExpRecordsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('fix_exp_records', function(Blueprint $table)
		{
			$table->dateTime('start_at');
			$table->dateTime('end_at')->default('9999-12-31');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('fix_exp_records', function(Blueprint $table)
		{
			$table->dropColumn('start_at');
			$table->dropColumn('end_at');
		});
	}

}
