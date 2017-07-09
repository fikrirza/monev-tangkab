<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRealisasiItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('realisasi_item', function(Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('item_id')->unsigned();
            $table->string('spd', 22);
            $table->integer('tahun');
            $table->bigInteger('nilai_1');
            $table->bigInteger('nilai_2');
            $table->bigInteger('nilai_3');
            $table->bigInteger('nilai_4');
            $table->timestamps();

            $table->foreign('item_id')->references('id')->on('item');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('realisasi_item');
    }
}
