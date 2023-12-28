<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Officer extends Model
{
    protected $fillable = ['username', 'fname', 'lname', 'password', 'email', 'image'];
    protected $table = null;




}