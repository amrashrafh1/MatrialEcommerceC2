<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('messages', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('m_from')->unsigned();
            $table->bigInteger('m_to')->unsigned();
			$table->string('message', 255);
			$table->bigInteger('product_id')->unsigned()->nullable();
			$table->bigInteger('conv_id')->unsigned();
			$table->boolean('is_read')->default(0);
            $table->foreign('m_to')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('m_from')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('conv_id')->references('id')->on('conversations')->onDelete('cascade');
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
        Schema::dropIfExists('messages');
    }
}
