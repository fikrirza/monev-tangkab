<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIndikatorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('indikator', function(Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('kegiatan_id')->unsigned();
            $table->enum('nama', [ 'MASUKAN', 'KELUARAN', 'HASIL', 'DAMPAK', 'MANFAAT' ]);
            $table->text('uraian')->nullable();
            $table->bigInteger('target')->nullable();
            $table->string('satuan')->nullable();
            $table->bigInteger('nilai_1')->nullable();
            $table->bigInteger('nilai_2')->nullable();
            $table->bigInteger('nilai_3')->nullable();
            $table->bigInteger('nilai_4')->nullable();
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
        Schema::dropIfExists('indikator');
    }
}
