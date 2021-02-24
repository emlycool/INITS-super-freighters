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
            $table->id();
            $table->string('order_no')->unique();
            $table->string('order_status');
            $table->string('fulfilment_status')->nullable();
            $table->string('customer_name');
            $table->string('email');
            $table->string('address');
            $table->string('item_weight');
            $table->string('item_description');
            $table->float('shipping_cost');
            $table->float('tax');
            $table->foreignId('transport_mode_id')->constrained();
            $table->string('shipping_country');
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
