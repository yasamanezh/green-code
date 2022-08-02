<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRowModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('row_modules', function (Blueprint $table) {
            $table->id();
            $table->string('sort')->nullable();
            $table->string('margin')->nullable();
            $table->string('padding')->nullable();
            $table->string('bg_color')->nullable();
            $table->string('bg_color_status')->nullable();
            $table->string('height')->nullable();
            $table->string('fullpage')->nullable();
            $table->string('page')->nullable();
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
        Schema::dropIfExists('row_modules');
    }
}
