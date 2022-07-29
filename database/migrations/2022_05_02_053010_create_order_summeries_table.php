<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderSummeriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_summeries', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('customer_name');
            $table->string('customer_email');
            $table->integer('customer_country_id');
            $table->string('customer_city');
            $table->text('customer_address');
            $table->string('customer_phone');
            $table->longText('order_notes');
            $table->string('payment_method');
            $table->float('sub_total');
            $table->float('shipping_charge');
            $table->string('coupon_name')->nullable();
            $table->float('discount_amount')->default(0);
            $table->float('grand_total');
            $table->string('payment_status')->default('unpaid');
            $table->string('order_status')->default('processing');
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
        Schema::dropIfExists('order_summeries');
    }
}
