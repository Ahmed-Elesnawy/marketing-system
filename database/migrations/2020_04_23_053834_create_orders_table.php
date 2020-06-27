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
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('orderId')->nullable();
            $table->double('total_price')->nullable();
            $table->double('total_commission')->nullable();
            $table->string('client_name');
            $table->string('client_address');
            $table->string('client_phone1');
            $table->string('client_phone2')->nullable();
            $table->enum('shipping_status',['pending','processing','shipped'])->default('pending');
            $table->enum('status',['canceld','discarded'])->nullable();
            $table->string('note')->nullable();
            $table->integer('shipping_number')->nullable();
            $table->dateTime('shipped_at')->nullable();
            $table->dateTime('canceld_at')->nullable();
            $table->dateTime('discarded_at')->nullable();
            $table->text('markter_note')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('province_id');
            $table->timestamps();

           /**
            * Table foregin keys
            */

            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');


            $table->foreign('province_id')
                  ->references('id')
                  ->on('provinces')
                  ->onDelete('cascade');


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





