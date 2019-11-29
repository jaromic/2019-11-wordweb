<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSynonymsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('synonyms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('word_a_id');
            $table->foreign('word_a_id')->references('id')->on('words')->onDelete('cascade');
            $table->unsignedBigInteger('word_b_id');
            $table->foreign('word_b_id')->references('id')->on('words')->onDelete('cascade');
            $table->unique(['word_a_id', 'word_b_id']);
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
        Schema::dropIfExists('synonyms');
    }
}
