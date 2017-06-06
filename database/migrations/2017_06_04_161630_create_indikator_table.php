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
            $table->increments('id');
            $table->integer('kegiatan_id')->unsigned();
            $table->enum('nama', [ 'MASUKAN', 'KELUARAN', 'HASIL', 'DAMPAK', 'MANFAAT' ]);
            $table->text('uraian')->nullable();
            $table->float('target')->nullable();
            $table->string('satuan')->nullable();
            $table->float('nilai_1'))->nullable();
            $table->float('nilai_2'))->nullable();
            $table->float('nilai_3'))->nullable();
            $table->float('nilai_4'))->nullable();
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
