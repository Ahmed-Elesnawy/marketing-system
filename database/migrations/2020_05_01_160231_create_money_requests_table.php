<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoneyRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('money_requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('phone');
            $table->double('money_needed');
            $table->boolean('is_confirmed')->default(0);
            $table->dateTime('confirmed_at')->nullable();
            $table->boolean('is_canceld')->default(0);
            $table->dateTime('canceld_at')->nullable();
            $table->text('note')->nullable();
            $table->unsignedBigInteger('user_id');
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
        Schema::dropIfExists('money_requests');
    }
}
