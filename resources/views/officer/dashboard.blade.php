<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Officer Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/Odashboard.css') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
      integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- Include Bootstrap CSS or any other styling if needed -->
</head>
<body>

    <div class="container mt-5">
        <h1>Officer Dashboard</h1>

        <a href="{{ route('officer.create-event') }}" class="btn btn-primary">Create Event</a>

        <h2>Event List</h2>

        @if(optional($events)->count() > 0)
            <ul class="list-group">
                @foreach($events as $event)
                    <li class="list-group-item">
                        <strong>{{ $event->eventName }}</strong>
                        <p>Description: {{ $event->description }}, Date: {{ $event->date }}, Time: {{ $event->time }}, Location: {{ $event->location }}</p>
                    </li>
                @endforeach
            </ul>
        @else
            <p>No events available.</p>
        @endif

    </div>

    <!-- Include Bootstrap JS and jQuery (optional) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
</body>
</html>
