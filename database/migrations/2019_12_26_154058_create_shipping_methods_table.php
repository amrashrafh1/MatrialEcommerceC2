<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShippingMethodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipping_methods', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->enum('rule', [
                'flat_rate_per_order',
                'quantity_based_per_order',
                'price_based_per_order',
                'flat_rate_per_item',
                'weight_based_per_item',
                'weight_based_per_order',
                'price_based_per_item'
            ]);
            $table->integer('weight')->nullable();
            $table->double('value', 8,2);
            $table->boolean('status')->default(0);
            $table->text('display_text')->nullable();
            $table->integer('company_id')->unsigned();
            $table->foreign('company_id')->references('id')->on('shipping_companies')->onDelete('cascade');
            $table->integer('zone_id')->unsigned();
            $table->foreign('zone_id')->references('id')->on('zones')->onDelete('cascade');
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
        Schema::dropIfExists('shipping_methods');
    }
}
