<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\EventType;
use App\Http\Controllers\Controller;



class EventTypeController extends Controller
{
    public function index()
    {
        // Fetch event types from the database
        $eventTypes = EventType::all();

        // Pass the event types to the view
        return $eventTypes;
    }

    
    public function createEventType(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'eventTypeName' => 'required|string|max:255|unique:event_types,eventTypeName',
            // Add other validation rules as needed
        ]);
    
        // Create a new event type only if it doesn't exist already
        $eventType = EventType::firstOrCreate(
            ['eventTypeName' => $validatedData['eventTypeName']], // Check if eventTypeName already exists
            $validatedData // Use the validated data to create if it doesn't exist
        );
    
        // Return the newly created or existing event type as a JSON response
        return response()->json($eventType, 201);
    }
    
   
public function deleteEventType($eventTypeID)
{
    // Find the EventType by ID
    $eventType = EventType::find($eventTypeID);

    // If EventType doesn't exist, return a 404 Not Found response
    if (!$eventType) {
        return response()->json(['message' => 'EventType not found'], 404);
    }

    // Delete the EventType
    $eventType->delete();

    // Return a success message indicating the deletion
    return response()->json(['message' => 'EventType deleted successfully'], 200);
}


}
