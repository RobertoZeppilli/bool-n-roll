<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('musician_id'); 
            $table->string('name', 20); 
            $table->string('surname', 50)->nullable(); 
            $table->string('email', 50); 
            $table->text('message'); 
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
        Schema::dropIfExists('messages');
    }
}
