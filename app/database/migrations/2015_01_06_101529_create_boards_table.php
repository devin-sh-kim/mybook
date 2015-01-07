<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBoardsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('boards', function(Blueprint $table)
		{
			$table->increments('id');               // id, key
            $table->integer('user_id');             // 사용자
            $table->string('title', 512);           // 제목
            $table->text('context');                // 내용
            $table->string('status', 100);          // 상태
            
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
		Schema::table('boards', function(Blueprint $table)
		{
			$table->drop();
		});
	}

}
