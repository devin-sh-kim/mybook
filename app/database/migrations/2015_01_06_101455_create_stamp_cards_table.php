<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStampCardsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('stamp_cards', function(Blueprint $table)
		{
			$table->increments('id');               // id, key
            $table->integer('user_id');             // 사용자
            $table->text('goal');                   // 목표
            $table->integer('reset_type');          // 리셋 타입(매월=3, 매주=2, 매일=1, 없음=0)
            $table->integer('reset_day');           // 리셋 일(매월 x일, 매주 x요일, 매일, 없음)
            $table->integer('max_stamp_num');       // 목표 스탬프 갯수
            $table->date('end_date');               // 종료 일
            $table->integer('stamp_theme_id');      // 스탬프 테마
            $table->string('input_value', 1);         // 스탬프 시 값 입력
            
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
		Schema::table('stamp_cards', function(Blueprint $table)
		{
			$table->drop();
		});
	}

}
