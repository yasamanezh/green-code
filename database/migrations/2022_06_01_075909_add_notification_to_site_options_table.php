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
            $table->after('order_complate_sms', function ($table) {
                $table->string('register_sms_admin')->nullable();
                $table->string('register_email_admin')->nullable();
                $table->string('order_sms_admin')->nullable();
                $table->string('order_email_admin')->nullable();
                $table->string('comment_sms')->nullable();
                $table->string('comment_email')->nullable();
                $table->string('question_sms')->nullable();
                $table->string('question_email')->nullable();
                $table->string('comment_product_sms')->nullable();
                $table->string('comment_product_email')->nullable();
                $table->string('contact_sms')->nullable();
                $table->string('contact_email')->nullable();
            });
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
