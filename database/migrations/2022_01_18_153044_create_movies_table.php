<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->string('naslov');
            $table->string('redatelj');
            $table->foreignId('genre_id');
            $table->smallInteger('trajanje')->unsigned()->default(90);
            $table->smallInteger('godina_izlaska')->unsigned();
            $table->text('uloge');
            $table->mediumText('opis');
            //$movies->opis = (string)$request->input('opis');
            $table->timestamps();
            $table->foreign('genre_id')->references('id')->on('genres');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movies');
    }
}
