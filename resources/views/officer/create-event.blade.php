<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Event</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
      integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- Include Bootstrap CSS or any other styling if needed -->
</head>
<body>

    <div class="container mt-5">
        <h1>Create Event</h1>

        <form action="{{ route('officer.store-event') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="eventName">Event Name:</label>
                <input type="text" class="form-control" name="eventName" required>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <input type="text" class="form-control" name="description" required>
            </div>
            <div class="form-group">
                <label for="date">Date:</label>
                <input type="date" class="form-control" name="date" required>
            </div>
            <div class="form-group">
                <label for="time">Time:</label>
                <input type="text" class="form-control" name="time" required>
            </div>
            <div class="form-group">
                <label for="location">Location:</label>
                <input type="text" class="form-control" name="location" required>
            </div>

            <div class="form-group">
    <label for="eventTypeID">Event Type:</label>
    <select class="form-control" name="eventTypeID" required>
        @foreach($eventTypes as $eventType)
            <option value="{{ $eventType->eventTypeID }}">{{ $eventType->eventTypeName }}</option>
        @endforeach
    </select>
</div>






            <button type="submit" class="btn btn-primary">Create Event</button>

            @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

        </form>

    </div>

    <!-- Include Bootstrap JS and jQuery (optional) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
