<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingDefsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('setting_defs', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('setting_id');
			$table->string('title', 256);
			$table->text('desc');
			
			$table->timestamps();
			
			$table->unique('setting_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('setting_defs', function(Blueprint $table)
		{
			$table->drop();
		});
	}

}
