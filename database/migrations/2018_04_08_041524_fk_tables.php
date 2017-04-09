<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FkTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jogos',function ($table){
            $table->foreign('competition_id')->references('id')->on('campeonatos');
            $table->foreign('home_id')->references('id')->on('times');
            $table->foreign('away_id')->references('id')->on('times');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
