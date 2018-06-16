<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateResumesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('resumes', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 20)->default('');
			$table->boolean('status')->default(1)->comment('目前状态：在职1/离职0');
			$table->string('remark')->default('');
			$table->integer('created_at')->unsigned()->default(0);
			$table->integer('updated_at')->unsigned()->default(0);
			$table->smallInteger('sort')->default(0);
			$table->integer('worked_at')->unsigned()->default(0)->comment('参加工作时间');
			$table->integer('user_id')->unsigned()->index('user_id');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('resumes');
	}

}
