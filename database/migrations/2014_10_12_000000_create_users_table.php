<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('dealer_id')->nullable();
            $table->unsignedInteger('inviter_id')->nullable()->comment('邀请人id');
            $table->enum('sex', [1, 2])->nullable()->comment('性别：1：男 2：女');
            $table->string('address')->nullable()->comment('地址');
            $table->string('name')->nullable();
            $table->string('tel')->nullable();
            $table->string('password')->nullable();
            $table->string('open_id')->nullable()->conmment('小程序open_id');
            $table->string('weChat_id')->nullable()->conmment('公众号open_id');
            $table->string('ticket')->nullable()->conmment('二维码id');
            $table->string('union_id')->nullable()->conmment('公众号小程序唯一id');
            $table->string('poster_id',32)->nullable()->conmment('海报媒体id');
            $table->string('head_url')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
