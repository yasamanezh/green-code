<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('options', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products') ->onUpdate('cascade')->onDelete('cascade');
            $table->string('option')->nullable();
            $table->string('value')->nullable();
            $table->string('count')->nullable();
            $table->string('color')->nullable();
            $table->string('anbar')->nullable();
            $table->string('price')->nullable();
            $table->string('price_prefix')->nullable();
            $table->string('weight_prefix')->nullable();
            $table->string('weight')->nullable();
            $table->string('type')->nullable();
            $table->string('required')->nullable();
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
        Schema::dropIfExists('options');
    }
}
