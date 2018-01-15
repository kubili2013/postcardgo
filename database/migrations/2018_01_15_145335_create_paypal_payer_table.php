<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaypalPayerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paypal_payer', function (Blueprint $table) {
            $table->increments('id');
            $table->string("email",128)->nullable(true);
            $table->string("payer_id",128)->nullable(true);
            $table->string("first_name",128)->nullable(true);
            $table->string("last_name",128)->nullable(true);
            $table->string("recipient_name",128)->nullable(true);
            $table->string("shipping_address_line1",128)->nullable(true);
            $table->string("shipping_address_city",128)->nullable(true);
            $table->string("shipping_address_state",128)->nullable(true);
            $table->string("postal_code",128)->nullable(true);
            $table->string("country_code",64)->nullable(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('paypal_payer');
    }
}
