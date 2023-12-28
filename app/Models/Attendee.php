<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendee extends Model
{
    protected $primaryKey = 'attendeeID'; // If 'attendeeID' is your primary key

    public function event()
    {
        return $this->belongsTo(Event::class, 'eventID'); // Adjust the foreign key column if needed
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'userID');
    }
    // Define other properties and methods as needed
}
