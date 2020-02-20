<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShippingChargesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipping_charges', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('country');
            $table->float('shipping_charge')->default(0);
            $table->float('shipping_charge_0_500g')->default(0);
            $table->float('shipping_charge_501_1000g')->default(0);
            $table->float('shipping_charge_1001_2000g')->default(0);
            $table->float('shipping_charge_2001_5000g')->default(0);
            $table->tinyInteger('status')->default(0)->nullable();
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
        Schema::dropIfExists('shipping_charges');
    }
}
