<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMemosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('memos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id');
			$table->string('title', 512);
			$table->text('context');
			$table->string('filename', 256);
			$table->string('attach_key', 256);
			$table->string('attach_type', 16);
			
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
		Schema::table('memos', function(Blueprint $table)
		{
			$table->drop();
		});
	}

}
