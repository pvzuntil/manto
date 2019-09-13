<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTkarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tkars', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idUser')->unsigned()->index();
            $table->text('nama');
            $table->text('email');
            $table->text('password');
            $table->text('level');
            $table->timestamps();

            $table->foreign('idUser')->references('id')->on('tusers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tkars');
    }
}
