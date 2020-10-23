<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('sku')->unique();
            $table->enum('product_type',['simple', 'variable']);
            $table->double('purchase_price', 8, 2);
            $table->double('sale_price', 8, 2);
            $table->integer('stock');
            $table->string('size')->nullable();
            $table->string('color')->nullable();
            $table->string('short_description', 255)->nullable();
            $table->text('description')->nullable();
            $table->json('data')->nullable();
            $table->string('image')->nullable();
            $table->bigInteger('tradmark_id')->unsigned()->nullable();
            $table->bigInteger('user_id')->unsigned();
            $table->enum('owner',['for_seller', 'for_site_owner'])->nullable();
            $table->bigInteger('category_id')->unsigned()->nullable();
            $table->boolean('approved')->default('0');
            /* Dimensions */
            $table->integer('length')->nullable();
            $table->integer('width')->nullable();
            $table->integer('height')->nullable();
            $table->integer('weight')->nullable();
            /* Status */
            $table->enum('section',['hot_new_arrivals','trending_now','make_dreams_your_reality','none'])->default('none');
            $table->enum('in_stock',['in_stock','out_stock']);
            $table->enum('visible',['visible','hidden']);
            $table->enum('has_accessories',['yes','no'])->default('no');;
            $table->double('tax', 8, 2)->nullable();


            $table->string('meta_tag')->nullable();
            $table->string('meta_keyword')->nullable();
            $table->string('meta_description')->nullable();
            /* Foregin Keys */
            $table->foreign('tradmark_id')->references('id')->on('tradmarks')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
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
        Schema::dropIfExists('products');
    }
}
