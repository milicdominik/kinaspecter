<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shows', function (Blueprint $table) {
            $table->id();
            $table->string('naziv');
            $table->foreignId('movie_id');
            $table->foreignId('hall_id');
            $table->datetime('datum_i_vrijeme_odrzavanja');
            $table->smallInteger('trajanje')->unsigned()->default(100);
            $table->timestamps();
            $table->foreign('movie_id')->references('id')->on('movies');
            $table->foreign('hall_id')->references('id')->on('halls');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shows');
    }
}
