<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSellerInfoUserPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seller_info_user', function (Blueprint $table) {
            $table->bigInteger('followee_id')->unsigned()->index();
            $table->foreign('followee_id')->references('id')->on('seller_infos')->onDelete('cascade');
            $table->bigInteger('follower_id')->unsigned()->index();
            $table->foreign('follower_id')->references('id')->on('users')->onDelete('cascade');
            $table->primary(['follower_id', 'followee_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seller_info_user');
    }
}
