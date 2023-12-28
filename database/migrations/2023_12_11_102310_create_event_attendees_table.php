<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventAttendeesTable extends Migration
{
    public function up()
    {
        Schema::create('event_attendees', function (Blueprint $table) {
            $table->unsignedBigInteger('eventID');
            $table->unsignedBigInteger('attendeeID');
            $table->primary(['eventID', 'attendeeID']);

            $table->foreign('eventID')->references('eventID')->on('events');
            $table->foreign('attendeeID')->references('attendeeID')->on('attendees');
        });
    }

    public function down()
    {
        Schema::dropIfExists('event_attendees');
    }
}