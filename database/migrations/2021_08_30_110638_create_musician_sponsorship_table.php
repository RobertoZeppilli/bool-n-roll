<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMusicianSponsorshipTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('musician_sponsorship', function (Blueprint $table) {
            $table->id();
            $table->timestamps(); 
            $table->dateTime('end_date'); 
            $table->unsignedBigInteger('musician_id'); 
            $table->foreign('musician_id')
                ->references('id')
                ->on('musicians')
                ->onDelete('CASCADE'); 

            $table->unsignedBigInteger('sponsorship_id'); 
            $table->foreign('sponsorship_id')
                ->references('id')
                ->on('sponsorships')
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
        Schema::dropIfExists('musician_sponsorship');
    }
}
