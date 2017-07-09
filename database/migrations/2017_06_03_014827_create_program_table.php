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
            $table->bigIncrements('id');
            $table->string('rekening', 7);
            $table->string('skpd_id', 10);
            $table->string('nama');
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
