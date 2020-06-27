<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSizeProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('size_product', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('size_id');
            $table->unsignedBigInteger('product_id');

            $table->timestamps();

             /**
             * Foreign Keys
             *
             */

            $table->foreign('product_id')
            ->references('id')
            ->on('products')
            ->onDelete('cascade');

            $table->foreign('size_id')
            ->references('id')
            ->on('sizes')
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
        Schema::dropIfExists('size_product');
    }
}
