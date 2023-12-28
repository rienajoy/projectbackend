<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\EventType;

class EventTypeSeeder extends Seeder
{
    public function run()
    {
        $defaultEventTypes = [
            ['eventTypeName' => 'Community Service'],
            ['eventTypeName' => 'Environmental Activities'],
            ['eventTypeName' => 'Gatherings'],
            // Add more default event types as needed
        ];

        // Insert default event types into the event_types table
        foreach ($defaultEventTypes as $eventTypeData) {
            EventType::create($eventTypeData);
        }
    }
}
