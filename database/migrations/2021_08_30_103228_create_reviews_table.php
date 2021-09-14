<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('musician_id'); 
            $table->string('name', 20); 
            $table->string('surname', 50)->nullable(); 
            $table->string('email', 50);
            $table->text('review'); 
            $table->tinyInteger('vote'); 
            $table->timestamps();

            $table->foreign('musician_id')
                ->references('id')
                ->on('musicians');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reviews');
    }
}
