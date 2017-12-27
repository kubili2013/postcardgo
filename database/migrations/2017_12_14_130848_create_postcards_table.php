<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostcardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('postcards', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email',64)->comment('收信人email');
            $table->string('real_name',64)->comment('收信人姓名');
            $table->string('type',32)->comment('类型');
            $table->string('country',64)->comment('收信人国家');
            $table->string('address',1024)->comment('收信人地址');
            $table->string('postcode',32)->comment('收信人邮政编码');
            $table->string('message',1024)->comment('寄语');
            $table->string('status',32)->default('创建')->comment('状态,已创建,已支付,准备寄出,已经寄出,已经签收,丢失');
            $table->string('ip',64)->comment('创建时ip');
            $table->string('image',255)->comment('postcard 实物图片')->default('postcard.jpg');
            $table->unsignedInteger('user_id')->comment('用户id');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::dropIfExists('postcards');
    }
}
