<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discounts', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable();
            $table->string('percent')->nullable();
            $table->string('product_id')->nullable();
            $table->string('special')->nullable();
            $table->string('discount')->nullable();
            $table->string('status')->nullable();
            $table->string('count')->nullable();
            $table->string('minimum')->nullable();
            $table->string('date_expire')->nullable();
            $table->string('time_expire')->nullable();
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
        Schema::dropIfExists('discounts');
    }
}
