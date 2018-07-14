<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePositionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('positions', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 20)->default('');
			$table->boolean('status')->default(1);
			$table->string('remark')->default('');
			$table->integer('created_at')->unsigned()->default(0);
			$table->integer('updated_at')->unsigned()->default(0);
			$table->smallInteger('sort')->default(0);
			$table->string('keywords', 245)->default('');
			$table->boolean('room_and_board')->default(0)->comment('管吃管住3、管吃1、管住2、不包0');
			$table->smallInteger('number')->unsigned()->default(0)->comment('预招人数');
			$table->text('content', 65535)->comment('职位详情');
			$table->string('benefit', 245)->default('')->comment('福利待遇');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('positions');
	}

}
