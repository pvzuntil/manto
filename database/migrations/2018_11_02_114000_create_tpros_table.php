<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTprosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tpros', function (Blueprint $table) {
          $table->increments('id');
          $table->text('nama');
          $table->text('harga');
          $table->text('stok');
          $table->text('stokawal')->nullable();
          $table->text('img')->nullable();
          $table->integer('idKat')->unsigned()->index();
          $table->text('kode');
          $table->text('fullkode');
          $table->integer('idUser')->unsigned()->index();
          $table->text('hargaBeli');
          $table->timestamps();

          $table->foreign('idKat')->references('id')->on('tkats')->onDelete('cascade');
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
        Schema::dropIfExists('tpros');
    }
}
