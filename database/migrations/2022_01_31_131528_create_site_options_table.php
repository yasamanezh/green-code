<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiteOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('site_options', function (Blueprint $table) {
            $table->id();
            $table->string('home')->nullable();
            $table->string('name')->nullable();
            $table->string('zone')->nullable();
            $table->string('city')->nullable();
            $table->text('address')->nullable();
            $table->text('geocode')->nullable();
            $table->string('email')->nullable();
            $table->string('telephone')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keyword')->nullable();
            $table->string('logo')->nullable();
            $table->string('icon')->nullable();
            $table->string('mail_parameter')->nullable();
            $table->string('mail_username')->nullable();
            $table->string('mail_password')->nullable();

            $table->text('samandehi')->nullable();
            $table->text('enamad')->nullable();
            $table->text('saderat_terminal')->nullable();
            $table->string('saderat_status')->nullable();
            $table->string('offline_pay')->nullable();
            $table->string('zarrinpall_status')->nullable();
            $table->text('zarrinpall_merchent')->nullable();
            $table->string('meli_status')->nullable();
            $table->text('meli_terminal')->nullable();
            $table->text('meli_merchent')->nullable();
            $table->text('meli_key')->nullable();
            $table->text('sms_panel')->nullable();
            $table->string('sms_usename')->nullable();
            $table->string('sms_password')->nullable();


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
        Schema::dropIfExists('site_options');
    }
}
