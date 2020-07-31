<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discounts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('condition', [
                  'percentage_of_product_price',
                  'fixed_amount',
                  'buy_x_and_get_y_free'
                  ]);
                  $table->dateTime('start_at');
                  $table->dateTime('expire_at');
                  $table->double('amount', 8, 2);
                  $table->enum('daily', ['none', 'daily_deals', 'special_offers'])->default('none');
                  $table->integer('max_quantity');
                  $table->integer('buy_x_quantity')->nullable();
                  $table->integer('y_quantity')->nullable();
                  $table->bigInteger('product_id')->unsigned();
                  $table->bigInteger('product_y')->unsigned()->nullable();
                  $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
                  $table->foreign('product_y')->references('id')->on('products')->onDelete('cascade');
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
        Schema::dropIfExists('discounts');
    }
}
