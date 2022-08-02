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
        Schema::table('site_options', function (Blueprint $table) {
            $table->string('register_sms')->nullable();
            $table->string('register_email')->nullable();
            $table->string('order_sms')->nullable();
            $table->string('order_email')->after('order_sms')->nullable();
            $table->string('order_complate_email')->nullable();
            $table->string('order_complate_sms')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('site_options', function (Blueprint $table) {
            //
        });
    }
};
