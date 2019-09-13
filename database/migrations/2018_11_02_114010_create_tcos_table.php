<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTcosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tcos', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('idUser')->unsigned()->index();
          $table->integer('idPro')->unsigned()->index();
          $table->text('banyak');
          $table->timestamps();

          $table->foreign('idUser')->references('id')->on('tusers')->onDelete('cascade');
          $table->foreign('idPro')->references('id')->on('tpros')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tcos');
    }
}
