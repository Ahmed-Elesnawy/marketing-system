<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTechCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tech_cards', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->text('content');
            $table->text('reply')->nullable();
            $table->dateTime('closed_at')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            /**
             * Foregn Keys
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
        Schema::dropIfExists('tech_cards');
    }
}
