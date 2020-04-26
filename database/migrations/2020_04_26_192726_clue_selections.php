<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ClueSelections extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clue_selections', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('clue_id');
            $table->foreign('clue_id')->references('id')->on('clues')->cascadeOnDelete();

            $table->unsignedBigInteger('player_id');
            $table->foreign('player_id')->references('id')->on('players')->cascadeOnDelete();

            $table->string('session_id');
            $table->foreign('session_id')->references('id')->on('sessions')->cascadeOnDelete();

            $table->boolean('complete')->default(false);

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
        Schema::dropIfExists('clue_selections');
    }
}
