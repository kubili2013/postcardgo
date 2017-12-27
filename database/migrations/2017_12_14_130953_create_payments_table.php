<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('payment_id',64)->comment('paypal 付款id');
            $table->string('payer',128)->comment('paypal 支付用户');
            $table->string('status',32)->comment('paypal 支付状态');
            $table->float('amount')->comment('paypal 支付金额');
            $table->unsignedInteger('postcard_id')->comment('关联支付的 postcard');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('postcard_id')->references('id')->on('postcards');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
