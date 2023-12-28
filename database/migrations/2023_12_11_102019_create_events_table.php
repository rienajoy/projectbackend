<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id('eventID');
            $table->string('eventName', 100);
            $table->string('description', 500);
            $table->date('date');
            $table->string('time');
            $table->string('location', 100);
            $table->unsignedBigInteger('eventTypeID');
            $table->timestamps();

            $table->foreign('eventTypeID')->references('eventTypeID')->on('event_types');
        });
    }

    public function down()
    {
        Schema::dropIfExists('events');
    }
}