<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMoneybookCategoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('moneybook_categories', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id');
			$table->integer('level');
			$table->integer('parent_id');
			$table->string('disp_name', 128);
			$table->integer('order');
			$table->string('use_yn', 1)->default('N');
			$table->string('code', 16);
			$table->string('parent_code', 16);
			$table->string("icon", 128);
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
		Schema::table('moneybook_categories', function(Blueprint $table)
		{
			$table->drop();
		});
	}

}
