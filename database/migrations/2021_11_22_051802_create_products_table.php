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
            $table->id();
            $table->string('title')->nullable();
            $table->longText('description')->nullable();
            $table->string('slug')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keyword')->nullable();
            $table->integer('sell')->nullable();
            $table->string('location')->nullable();
            $table->bigInteger('price')->nullable();
            $table->string('status')->nullable();
            $table->string('manufacturer')->nullable();
            $table->string('category')->nullable();
            $table->string('related')->nullable();
            $table->string('anbar')->nullable();
            $table->string('image')->nullable();
            $table->string('type')->nullable();
            $table->string('demo')->nullable();
            $table->string('shipping')->nullable();
            $table->string('warrenty')->nullable();
            $table->integer('countsell')->nullable();
            $table->string('Release_date')->nullable();
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
