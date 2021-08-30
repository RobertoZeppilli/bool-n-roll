<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGenreMusicianTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('genre_musician', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('genre_id'); 
            $table->foreign('genre_id')
                ->references('id')
                ->on('genres')
                ->onDelete('CASCADE'); 

            $table->unsignedBigInteger('musician_id'); 
            $table->foreign('musician_id')
                ->references('id')
                ->on('musicians')
                ->onDelete('CASCADE');       
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('genre_musician');
    }
}
