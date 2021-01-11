<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShippingCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipping_companies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();
            $table->string('contact_name')->nullable();
            $table->string('address')->nullable();
            $table->string('mobile')->nullable();
            $table->boolean('traking')->default(0);
            $table->string('icon')->nullable();
            $table->integer('country_id')->unsigned();
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
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
        Schema::dropIfExists('shipping_companies');
    }
}
