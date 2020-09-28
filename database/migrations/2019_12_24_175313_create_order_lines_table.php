<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderLinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_lines', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('order_id')->unsigned();
            $table->foreign('order_id')->references('id')->on('orders');
            $table->integer('quantity');
            $table->double('total', 10, 2);
            $table->double('price', 10, 2);
            $table->double('discount', 10, 2)->nullable();
            $table->string('discount_details', 400)->nullable();
            $table->double('tax', 8, 2)->nullable();
            $table->double('shipping', 8, 2)->nullable();
            $table->string('sku')->index();
            $table->string('product');
            $table->json('options')->nullable();
            $table->bigInteger('seller_id')->nullable()->unsigned();
            $table->foreign('seller_id')->references('id')->on('users');
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
        Schema::dropIfExists('order_lines');
    }
}
