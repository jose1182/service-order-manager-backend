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
            $table->unsignedBigInteger('service_id')->nullable();
            $table->string('order_service');
            $table->string('costumer_code');
            $table->string('costumer_name');
            $table->string('pev');
            $table->date('order_date');
            $table->date('shipment_date');
            $table->string('product_name');
            $table->text('description', 500);
            $table->integer('quantity');
            $table->timestamps();
            $table->index('service_id');
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
