<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->tinyIncrements('id');
            $table->string('sitename');
            $table->string('mobile');
            $table->string('location');
            $table->string('email')->nullable();
            $table->string('logo')->nullable();
            $table->string('icon')->nullable();
            $table->enum('system_status', ['open', 'close'])->default('open');
            $table->longtext('system_message')->nullable();
            $table->tinyInteger('fees');
            $table->boolean('default_shipping')->default(1);
            $table->boolean('paypal')->default(1);
            $table->boolean('stripe')->default(1);
            $table->unsignedInteger('shipping_method')->nullable();
            $table->foreign('shipping_method')->references('id')->on('shipping_methods')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
