<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFootersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('footers', function (Blueprint $table) {
            $table->id();
            $table->string('icon_1')->nullable();
            $table->string('icon_2')->nullable();
            $table->string('icon_3')->nullable();
            $table->string('icon_4')->nullable();
            $table->string('icon_5')->nullable();
            $table->string('title_1')->nullable();
            $table->string('title_2')->nullable();
            $table->string('title_3')->nullable();
            $table->string('title_4')->nullable();
            $table->string('title_5')->nullable();
            $table->string('link_1')->nullable();
            $table->string('link_2')->nullable();
            $table->string('link_3')->nullable();
            $table->string('link_4')->nullable();
            $table->string('link_5')->nullable();
            $table->text('footer_bottom')->nullable();
            $table->string('category_1')->nullable();
            $table->string('category_2')->nullable();
            $table->string('category_3')->nullable();
            $table->string('title_sub_31')->nullable();
            $table->string('title_sub_32')->nullable();
            $table->string('title_sub_33')->nullable();
            $table->string('title_sub_34')->nullable();
            $table->string('title_sub_35')->nullable();
            $table->string('title_sub_21')->nullable();
            $table->string('title_sub_22')->nullable();
            $table->string('title_sub_23')->nullable();
            $table->string('title_sub_24')->nullable();
            $table->string('title_sub_25')->nullable();
            $table->string('title_sub_1')->nullable();
            $table->string('title_sub_2')->nullable();
            $table->string('title_sub_3')->nullable();
            $table->string('title_sub_4')->nullable();
            $table->string('title_sub_5')->nullable();

            $table->string('link_sub_31')->nullable();
            $table->string('link_sub_32')->nullable();
            $table->string('link_sub_33')->nullable();
            $table->string('link_sub_34')->nullable();
            $table->string('link_sub_35')->nullable();
            $table->string('link_sub_21')->nullable();
            $table->string('link_sub_22')->nullable();
            $table->string('link_sub_23')->nullable();
            $table->string('link_sub_24')->nullable();
            $table->string('link_sub_25')->nullable();
            $table->string('link_sub_1')->nullable();
            $table->string('link_sub_2')->nullable();
            $table->string('link_sub_3')->nullable();
            $table->string('link_sub_4')->nullable();
            $table->string('link_sub_5')->nullable();


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
        Schema::dropIfExists('footers');
    }
}
