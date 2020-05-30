<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHighCardPlays extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('highCardPlays', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('userScore');
            $table->integer('compScore');
            $table->boolean('userWon');
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
        Schema::dropIfExists('highCardPlays');
    }
}
