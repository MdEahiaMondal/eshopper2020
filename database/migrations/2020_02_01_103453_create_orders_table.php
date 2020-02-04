<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->string('shipping_name',100);
            $table->string('shipping_email',150);
            $table->string('shipping_country',70);
            $table->string('shipping_state',60);
            $table->string('shipping_city',60);
            $table->string('shipping_zipcode',40);
            $table->string('shipping_phone',50);
            $table->text('shipping_address');
            $table->string('coupon_code');
            $table->float('coupon_amount',10);
            $table->string('payment_method',15);
            $table->float('shipping_charge');
            $table->float('grand_total');
            $table->string('status')->default('new');
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
        Schema::dropIfExists('orders');
    }
}
