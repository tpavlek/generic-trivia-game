<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuzzerResolutionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buzzer_resolutions', function (Blueprint $table) {
            $table->id();

            $table->string('session_id');
            $table->foreign('session_id')->references('id')->on('sessions')->cascadeOnDelete();

            $table->unsignedBigInteger('clue_id');
            $table->foreign('clue_id')->references('id')->on('clues')->cascadeOnDelete();

            $table->unsignedBigInteger('winner_id')->nullable();
            $table->foreign('winner_id')->references('id')->on('players')->cascadeOnDelete();

            $table->boolean('resolved')->default(false);

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
        Schema::dropIfExists('buzzer_resolutions');
    }
}
