<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecordsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('records', function(Blueprint $table)
		{
                $table->increments('id');               // id, key
                $table->integer('user_id');             // 사용자
                $table->string('type', 3);              // 수입, 지출
                $table->integer('value');               // 금액
                $table->dateTime('target_at');          // 대상 일
                $table->text('context');                // 내용
       			$table->integer('fix_exp_id')->default('0');
				$table->string('category_code', 16)->defualt('00');
				
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
		Schema::table('records', function(Blueprint $table)
		{
			$table->drop();
		});
	}

}
