<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id('userID');
            $table->string('username', 50);
            $table->string('fname', 20);
            $table->string('lname', 20);
            $table->string('password', 255);
            $table->string('email', 50);
            $table->boolean('is_admin')->default(false);
            $table->boolean('is_officer')->default(false);
            $table->string('org_code');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
