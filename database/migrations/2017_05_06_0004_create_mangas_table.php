<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMangasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mangas', function(Blueprint $table){
           $table->increments('id');
           $table->string('title');
           $table->date('publishedAt');
           $table->integer('volume');
           $table->float('price');
           $table->string('isbn');
           $table->integer('serie_id')->unsigned();
           $table->foreign('serie_id')->references('id')->on('series');
           $table->string('cover')->nullable();
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
        Schema::drop('mangas');
    }
}
