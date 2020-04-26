<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuzzesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buzzes', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('buzzer_resolution_id');
            $table->foreign('buzzer_resolution_id')->references('id')->on('buzzer_resolutions')->cascadeOnDelete();

            $table->unsignedBigInteger('player_id');
            $table->foreign('player_id')->references('id')->on('players')->cascadeOnDelete();

            $table->unsignedInteger('time');

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
        Schema::dropIfExists('buzzes');
    }
}
