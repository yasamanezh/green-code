<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateColumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('colums', function (Blueprint $table) {
            $table->id();
            $table->string('row')->nullable();
            $table->string('sort')->nullable();
            $table->string('col')->nullable();
            $table->string('col_lg')->nullable();
            $table->string('col_md')->nullable();
            $table->string('col_xs')->nullable();
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
        Schema::dropIfExists('colums');
    }
}
