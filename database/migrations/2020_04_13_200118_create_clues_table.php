<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCluesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clues', function (Blueprint $table) {
            $table->id();

            $table->unsignedInteger('value');
            $table->string('text');
            $table->string('answer');

            $table->boolean('is_daily_double')->default(false);

            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories');


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
        Schema::dropIfExists('clues');
    }
}
