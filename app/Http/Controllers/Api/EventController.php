<?php

namespace App\Http\Controllers\Api;

use App\Models\Event;
use App\Models\EventType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Models\Attendee;
use Illuminate\Support\Facades\Log;



class EventController extends Controller
{
    public function index()
    {
        try {
            $events = Event::all();

            return response()->json(['events' => $events], 200);
        } catch (\Exception $e) {
            Log::error('Error fetching events: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to retrieve events'], 500);
        }
    }
    
    

    public function create(Request $request)
    {
        // Validation logic here
        $formattedDate = Carbon::createFromFormat('m-d-Y', $request->input('date'))->format('Y-m-d');

        // Create the event
        $event = Event::create([
            'eventName' => $request->input('eventName'),
            'description' => $request->input('description'),
            'date' => $formattedDate,
            'time' => $request->input('time'),
            'location' => $request->input('location'),
            'eventTypeID' => $request->input('eventTypeID'),
        ]);

        // Check if the event was created successfully
        if ($event) {
            return response()->json([
                'success' => true,
                'message' => 'Event created successfully',
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create the event',
            ]);
        }
    }

    


public function deleteEvent($eventID)
{
    // Delete related attendees first
    Attendee::where('eventID', $eventID)->delete();

    // Now, delete the event
    $event = Event::find($eventID);

    if (!$event) {
        return response()->json([
            'success' => false,
            'message' => 'Event not found',
        ], 404);
    }

    $event->delete();

    return response()->json([
        'success' => true,
        'message' => 'Event deleted successfully',
    ]);
}

    public function deleteAllEvents()
    {
        // Delete all events and their associated records in event_attendees
        Event::with('attendees')->delete();

        return response()->json([
            'success' => true,
            'message' => 'All events deleted successfully',
        ]);
    }
    public function updateEvent(Request $request, $eventID)
    {
        // Validate the request data if needed
    
        $event = Event::find($eventID);
    
        if (!$event) {
            return response()->json([
                'success' => false,
                'message' => 'Event not found',
            ], 404);
        }
    
        // Update the event
        $formattedDate = Carbon::createFromFormat('Y-m-d', $request->input('date'));
    
        $event->eventName = $request->input('eventName');
        $event->description = $request->input('description');
        $event->date = $formattedDate;
        $event->time = $request->input('time');
        $event->location = $request->input('location');
        $event->eventTypeID = $request->input('eventTypeID');
        $event->save();
    
        return response()->json([
            'success' => true,
            'message' => 'Event updated successfully',
            'event' => $event,
        ]);
    }
    



    public function joinEvent($eventID, $userID)
    {
        $event = Event::find($eventID);
    
        if (!$event) {
            return response()->json([
                'success' => false,
                'message' => 'Event not found',
            ], 404);
        }
    
        // Find the attendee record
        $attendee = Attendee::where('userID', $userID)
            ->where('eventID', $eventID)
            ->first();
    
        if ($attendee) {
            // If the attendee exists, update the status to 'joined'
            $attendee->status = 'joined';
            $attendee->save();
    
            return response()->json([
                'success' => true,
                'message' => 'User rejoined the event successfully',
            ]);
        } else {
            // Create a new attendee for the user and attach to the event
            $newAttendee = new Attendee();
            $newAttendee->status = 'joined';
            $newAttendee->userID = $userID;
            $newAttendee->eventID = $eventID;
            $newAttendee->save();
    
            return response()->json([
                'success' => true,
                'message' => 'User joined the event successfully',
            ]);
        }
    }
    public function getEventAttendees($eventID)
    {
        // Find the event
        $event = Event::find($eventID);
    
        // Check if the event exists
        if (!$event) {
            return response()->json([
                'success' => false,
                'message' => 'Event not found',
            ], 404);
        }
    
        // Get only the attendees who have 'joined' status
        $attendees = $event->attendees()->where('status', 'joined')->with('user')->get();
    
        // You can customize the response format based on your needs
        $response = [
            'success' => true,
            'event' => $event,
            'attendees' => $attendees,
            'attendee_count' => $attendees->count(), // Count only joined attendees
        ];
    
        return response()->json($response);
    }
    

    public function cancelJoinEvent($eventID, $userID)
{
    $event = Event::find($eventID);

    if (!$event) {
        return response()->json([
            'success' => false,
            'message' => 'Event not found',
        ], 404);
    }

    // Find the attendee record
    $attendee = Attendee::where('userID', $userID)
        ->where('eventID', $eventID)
        ->first();

    if ($attendee) {
        // Update the status to 'declined'
        $attendee->status = 'declined';
        $attendee->save();

        return response()->json([
            'success' => true,
            'message' => 'User declined joining the event',
        ]);
    } else {
        return response()->json([
            'success' => false,
            'message' => 'User is not an attendee for this event',
        ]);
    }
}


public function getEventDeclinedAttendees($eventID)
{
    // Find the event
    $event = Event::find($eventID);

    // Check if the event exists
    if (!$event) {
        return response()->json([
            'success' => false,
            'message' => 'Event not found',
        ], 404);
    }

    // Get only the attendees who have 'declined' status
    $declinedAttendees = $event->attendees()->where('status', 'declined')->with('user')->get();

    // You can customize the response format based on your needs
    $response = [
        'success' => true,
        'event' => $event,
        'declined_attendees' => $declinedAttendees,
        'declined_attendee_count' => $declinedAttendees->count(),
    ];

    return response()->json($response);
}




    



}
