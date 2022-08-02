<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    protected $fillable=['','','','','','',
        '','',''];
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users') ->onUpdate('cascade')->onDelete('cascade');
            $table->string('order_number')->nullable();
            $table->string('name')->nullable();
            $table->string('status')->nullable();
            $table->string('copen_code')->nullable();
            $table->string('copen_price')->nullable();
            $table->string('cart_discount_price')->nullable();
            $table->string('payment_price')->nullable();
            $table->string('product_price')->nullable();
            $table->string('prices')->nullable();
            $table->string('send_factor')->nullable();
            $table->string('payment_type')->nullable();
            $table->string('shipping_type')->nullable();
            $table->string('processing')->nullable();
            $table->string('zone')->nullable();
            $table->string('city')->nullable();
            $table->string('driver')->nullable();
            $table->string('code_posti')->nullable();
            $table->string('transactionId')->nullable();
            $table->string('mobile')->nullable();
            $table->text('address')->nullable();
            $table->text('description')->nullable();

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
        Schema::dropIfExists('orders');
    }
}
