<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTracksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tracks', function (Blueprint $table) {
           $table->increments('id');
           $table->string('title', 255);
           $table->string('artist', 255);
           $table->string('path_lq', 255);
           $table->string('path_hq', 255);
           $table->integer('max_downloads');
           $table->integer('current_downloads');
           $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tracks');
    }
}
