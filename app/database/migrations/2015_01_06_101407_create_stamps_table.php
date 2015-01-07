<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStampsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('stamps', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id');
			$table->integer('stamp_card_id');
			$table->integer('stamp_card_type');
			$table->integer('stamp_theme_id');
			$table->string('value', 100)->nullable();
			$table->dateTime('stamped_at');
			
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
		Schema::table('stamps', function(Blueprint $table)
		{
			$table->drop();
		});
	}

}
