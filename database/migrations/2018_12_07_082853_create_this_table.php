<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateThisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('this', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idUser')->unsigned()->index();
            $table->integer('kodePembelian')->unsigned()->index();
            $table->text('nama');
            $table->text('harga');
            $table->text('hargaBeli');
            $table->text('banyak');
            $table->timestamps();

            $table->foreign('idUser')->references('id')->on('tusers')->onDelete('cascade');
            $table->foreign('kodePembelian')->references('kodePembelian')->on('tpels')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('this');
    }
}
