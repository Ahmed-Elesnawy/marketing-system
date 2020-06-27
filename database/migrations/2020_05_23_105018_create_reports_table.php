<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->date('from');
            $table->date('to');
            $table->integer('total_orders');
            $table->integer('shipped_orders');
            $table->integer('canceld_orders');
            $table->integer('discarded_orders');
            $table->double('shipped_to_total')->nullable();
            $table->double('total_porfits');
            $table->timestamps();


            /**
             * Foreign Keys
             * 
             */

             $table->foreign('user_id')
                   ->references('id')
                   ->on('users')
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
        Schema::dropIfExists('reports');
    }
}
