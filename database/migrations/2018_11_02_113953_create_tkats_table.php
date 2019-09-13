<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTkatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tkats', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('idUser')->unsigned()->index();
          $table->text('kodeKat');
          $table->text('nama');
          $table->text('desKat');
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
        Schema::dropIfExists('tkats');
    }
}
