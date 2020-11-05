<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCMSSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('c_m_s_s', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('type', ['categories', 'products']);
            $table->string('title');
            $table->dateTime('start_at');
            $table->dateTime('expire_at');
            $table->string('slug');
            $table->string('image');
            $table->string('meta_tag')->nullable();
            $table->string('meta_keyword')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('menuTitle');
            $table->text('content');
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
        Schema::dropIfExists('c_m_s_s');
    }
}
