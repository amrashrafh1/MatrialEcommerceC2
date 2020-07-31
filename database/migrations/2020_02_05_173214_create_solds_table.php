<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSoldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solds', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('sold')->default(0);
            $table->double('sale_price', 8, 2);
            $table->double('purchase_price', 8, 2);
            $table->double('fees', 8, 2);
            $table->double('coupon', 8, 2);
            $table->bigInteger('product_id')->unsigned();
            $table->json('options')->nullable();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
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
        Schema::dropIfExists('solds');
    }
}
