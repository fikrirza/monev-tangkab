<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemKegiatanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('kegiatan_id')->unsigned();
            $table->string('rekening', 12);
            $table->string('nama');
            $table->bigInteger('nilai_1')->nullable();
            $table->string('satuan_1')->nullable();
            $table->bigInteger('nilai_2')->nullable();
            $table->string('satuan_2')->nullable();
            $table->bigInteger('nilai_3')->nullable();
            $table->string('satuan_3')->nullable();
            $table->bigInteger('fisik');
            $table->bigInteger('realisasi');
            $table->bigInteger('total');
            $table->string('expr');
            $table->timestamps();

            $table->foreign('kegiatan_id')->references('id')->on('kegiatan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('item');
    }
}
