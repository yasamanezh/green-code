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
            $table->after('mail_password', function ($table) {
                $table->string('mail_mailer')->nullable();
                $table->string('mail_host')->nullable();
                $table->string('mail_port')->nullable();
                $table->string('mail_encription')->nullable();
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
