<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserSettingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_settings', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id');
			$table->integer('setting_id');
			$table->string('value', 256);
			
			$table->timestamps();
			$table->softDeletes();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('user_settings', function(Blueprint $table)
		{
			$table->drop();
		});
	}

}
