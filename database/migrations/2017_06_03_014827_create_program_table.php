<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProgramTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('program', function(Blueprint $table) {
            $table->increments('id');
            $table->string('rekening', 7);
            $table->string('skpd_id', 10);
            $table->string('nama');
            $table->float('nilai_1');
            $table->float('nilai_2');
            $table->float('nilai_3');
            $table->float('nilai_4');
            $table->timestamps();

            $table->foreign('skpd_id')->references('id')->on('skpd');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('program');
    }
}
