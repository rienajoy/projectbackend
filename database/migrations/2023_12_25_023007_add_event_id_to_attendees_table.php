<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('attendees', function (Blueprint $table) {
        $table->unsignedBigInteger('eventID');
        $table->foreign('eventID')->references('eventID')->on('events');
    });
}

public function down()
{
    Schema::table('attendees', function (Blueprint $table) {
        $table->dropForeign(['eventID']);
        $table->dropColumn('eventID');
    });
}
};
