<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLossesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('losses', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('loss_id')->comment('丢失');
            $table->unsignedInteger('new_id')->comment('新的');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('loss_id')->references('id')->on('postcards');
            $table->foreign('new_id')->references('id')->on('postcards');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('losses');
    }
}
