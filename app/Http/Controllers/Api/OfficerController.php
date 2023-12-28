<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\EventType;
use App\Http\Controllers\Controller;




class OfficerController extends Controller
{
    public function index()
    {
            // Example: Retrieve events and event types from the controller
        $events = Event::with('eventType')->get();
        $eventTypes = EventType::all();

                return $events;
        return $eventTypes; 
    }

    public function create(Request $request)
    {
        // Validation logic here

        Event::create([
            'eventName' => $request->input('eventName'),
            'description' => $request->input('description'),
            'date' => $request->input('date'),
            'time' => $request->input('time'),
            'location' => $request->input('location'),
            'eventTypeID' => $request->input('eventTypeID'),
        ]);

        return redirect()->route('event.events')->with('success', 'Event created successfully');
    }

   
    }
