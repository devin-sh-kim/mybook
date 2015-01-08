<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFixExpRecordsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fix_exp_records', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id');
			$table->string('type', 3);				// {INC, OUT}
			$table->string('cycle_type', 3);		// {Y, M, W, D}
			$table->string('cycle_day', 16);		// {Y:MM-DD, M:DD, W:WDAY, D:1}
			$table->integer('value');               // 금액
            $table->text('context');                // 내용
            
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
		Schema::table('fix_exp_records', function(Blueprint $table)
		{
			$table->drop();
		});
	}

}
