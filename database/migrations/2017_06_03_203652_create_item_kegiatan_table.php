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
            $table->bigIncrements('id');
            $table->bigInteger('kegiatan_id')->unsigned();
            $table->string('rekening', 12);
            $table->string('nama');
            $table->bigInteger('total');
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
