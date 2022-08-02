<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payamaks', function (Blueprint $table) {
            $table->id();
            $table->text('user_ids')->nullable();
            $table->text('content')->nullable();
            $table->string('time_send')->nullable();
            $table->string('date_send')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('payamaks');
    }
};
