<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTsetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tsets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idUser')->unsigned()->index();
            $table->text('imgProfil');
            $table->text('imgSampul');
            $table->text('syaratKetentuan');
            $table->text('tema');
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
        Schema::dropIfExists('tsets');
    }
}
