<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attributes', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('value')->nullable();
            $table->string('sort_order')->nullable();
            $table->unsignedBigInteger('group');
            $table->foreign('group')->references('id')->on('attribute_groups') ->onUpdate('cascade')->onDelete('cascade');
            $table->string('category_id')->nullable();

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
        Schema::dropIfExists('attributes');
    }
}
