<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecordSummaryMonthsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('record_summary_months', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id');
			$table->integer('year');		        
			$table->integer('month');		    
			$table->integer('day');		
			$table->integer('balance');              
            
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
		Schema::table('record_summary_months', function(Blueprint $table)
		{
			$table->drop();
		});
	}

}
