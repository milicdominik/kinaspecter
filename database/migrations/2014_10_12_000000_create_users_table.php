<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name'); //ovo je username
            $table->string('email')->unique();
            $table->string('ime');
            $table->string('prezime');
            $table->string('oib',13)->unique();
            $table->string('mobitel',12)->unique();
            $table->date('dat_god_rodenja');
            $table->boolean('is_posjetitelj')->default(true);
            $table->boolean('is_administracija')->default(false);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
