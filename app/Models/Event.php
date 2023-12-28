<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $primaryKey = 'eventID';
// Event.php
protected $fillable = ['eventName','description', 'date', 'time', 'location', 'eventTypeID', 'image'];

    // Event.php
protected $casts = [
    'eventTypeID' => 'integer',
];


    public function eventType()
    {
        return $this->belongsTo(EventType::class, 'eventTypeID');
    }

    
    public function users()
    {
        return $this->belongsToMany(User::class, 'attendees')->withPivot('status')->withTimestamps();
    }

    public function attendees()
    {
        return $this->hasMany(Attendee::class, 'eventID'); // Adjust the foreign key column if needed
    }
    
}
