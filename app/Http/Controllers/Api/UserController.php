<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventType;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {   
        $events = Event::with('eventType')->get();
        $eventTypes = EventType::all(); // Fetch all event types
        return view('UserDashboard', compact('events', 'eventTypes'));
    }


    public function getEvents($eventTypeId)
    {
        // Fetch events from the database where the 'eventTypeID' column matches the provided event type ID
        $events = Event::where('eventTypeID', $eventTypeId)->get();
    
        // Check if there are no events for the specified event type
        if ($events->isEmpty()) {
            // If no events found, you can return a specific view or a general message view
            return view('events.empty'); // Create 'empty.blade.php' in the 'resources/views/events' directory
        }
    
        // Return an HTML view with the fetched events
        return view('events.show', compact('events'));
    }
    


public function dashboard()
    {
        // Fetch event types from the database
        $eventTypes = EventType::all();

        // Pass the event types to the view
        return view('user.dashboard', compact('eventTypes'));
    }

   

}
    

