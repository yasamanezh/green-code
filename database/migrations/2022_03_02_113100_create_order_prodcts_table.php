<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderProdctsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_prodcts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->foreign('order_id')->references('id')->on('orders') ->onUpdate('cascade')->onDelete('cascade');
            $table->text('title')->nullable();
            $table->bigInteger('price')->nullable();
            $table->bigInteger('count')->nullable();
            $table->string('options')->nullable();
            $table->string('options_id')->nullable();
            $table->string('product_id')->nullable();
            $table->string('total')->nullable();
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
        Schema::dropIfExists('order_prodcts');
    }
}
