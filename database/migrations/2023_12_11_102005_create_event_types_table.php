<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventTypesTable extends Migration
{
    public function up()
    {
        Schema::create('event_types', function (Blueprint $table) {
            $table->id('eventTypeID');
            $table->string('eventTypeName', 100)->nullable(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('event_types');
    }
}