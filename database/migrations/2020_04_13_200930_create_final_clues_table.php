<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinalCluesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('final_clues', function (Blueprint $table) {
            $table->id();

            $table->string('category');
            $table->string('clue');
            $table->string('answer');

            $table->unsignedBigInteger('game_id');
            $table->foreign('game_id')->references('id')->on('games');

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
        Schema::dropIfExists('final_clues');
    }
}
