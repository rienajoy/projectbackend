<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendeesTable extends Migration
{
    public function up()
    {
        Schema::create('attendees', function (Blueprint $table) {
            $table->id('attendeeID');
            $table->enum('status', ['joined', 'declined'])->default('joined');
            $table->unsignedBigInteger('userID');
            $table->timestamps();

            $table->foreign('userID')->references('userID')->on('users');
        });
    }

    public function down()
    {
        Schema::dropIfExists('attendees');
    }
}
