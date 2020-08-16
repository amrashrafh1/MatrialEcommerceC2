<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdzsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adzs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('header', 225);
            $table->string('image', 255);
            $table->string('body', 255);
            $table->string('link', 255);
            $table->dateTime('start_at');
            $table->dateTime('expire_at');
            $table->boolean('status')->default(1);
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
        Schema::dropIfExists('adzs');
    }
}
