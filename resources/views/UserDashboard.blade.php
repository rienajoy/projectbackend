<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="{{('css/dashboard.css') }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
      <!-- Favicon -->
      <link href="img/favicon.ico" rel="icon">

<!-- Google Web Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&display=swap" rel="stylesheet">

<!-- Icon Font Stylesheet -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

<!-- Libraries Stylesheet -->
<link href="lib/animate/animate.min.css" rel="stylesheet">
<link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

<!-- Customized Bootstrap Stylesheet -->
<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<!-- Bootstrap JS (Popper.js and jQuery are required) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-Es5ZxdH8FDB1F2U4WmRFjqYYR6I/Sq6vA5fJxPNOjZR37eKAYB98VaFfsfEESKJ" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


</head>
<body>
     <!-- Navbar Start -->
     <nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
        <a href="index.html" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
            <h2 class="m-0 text-primary"><i class="fa fa-book me-3"></i>syncEvent</h2>
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
                <a href="index.html" class="nav-item nav-link active">Home</a>
                <a href="about.html" class="nav-item nav-link">About</a>
                <a href="courses.html" class="nav-item nav-link">Courses</a>
            </div>
            <div class="collapse navbar-collapse" id="navbarCollapse">
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img src="user-icon.jpg" alt="User Icon">
            </a>
            <div class="dropdown-menu" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">Profile</a>
                <a class="dropdown-item" href="#">Settings</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Logout</a>
            </div>
        </li>
    </ul>
</div>
        </div>
    </nav>
    <!-- Navbar End -->

    
    
  <!-- Courses Start -->
  <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">Event Types</h6>
                <h1 class="mb-5">Upcoming Events</h1>
            </div>
            <div class="row g-4 justify-content-center">
                @if(count($eventTypes) > 0)
                @php
                    function generatePastelColor($index) {
                        $pastelColors = [
                            '#FFB6C1', '#FFD700', '#98FB98', '#ADD8E6', '#F08080',
                            '#FF6347', '#DA70D6', '#87CEFA', '#C71585', '#87CEEB',
                            // Add more colors as needed
                        ];

                        $colorIndex = $index % count($pastelColors);

                        return $pastelColors[$colorIndex];
                    }
                @endphp

                @foreach($eventTypes as $key => $eventType)
                        <div class="col-lg-6 col-md-6 mb-4 wow fadeInUp" data-wow-delay="0.3s">
                            <div class="course-item" style="background-color: {{ generatePastelColor($key) }};">
                                <div class="position-relative overflow-hidden">
                                    <img class="img-fluid" src="{{ asset('img/about.jpg') }}" alt="">
                                </div>
                                <div class="text-center p-4 pb-0">
                                    <h5 class="mb-4">{{ $eventType->eventTypeName }}</h5>

                                    <!-- Add the onclick event to the "View Lists of Events" button -->
                                    <button class="flex-shrink-0 btn btn-sm btn-primary px-3 border-end"
                                        style="border-radius: 30px 0 0 30px; z-index: 2;">Read More</button>
                                    <!-- Update the button -->
                                    <button class="flex-shrink-0 btn btn-sm btn-primary px-3"
        onclick="showEventDetailsModal(
          '{{ $eventType->eventTypeName }}',
          {{ count($eventType->events) }},
          @foreach($eventType->events as $event)
            {
              eventName: '{{ $event->eventName }}',
              description: '{{ $event->description }}',
              date: '{{ $event->date }}',
              time: '{{ $event->time }}',
              location: '{{ $event->location }}'
            },
          @endforeach
        )"
        style="border-radius: 0 30px 30px 0; z-index: 2;">View Lists of Events</button>


                                     <!-- Display event details -->
                                     @if(count($eventType->events) > 0)
                                        <ul class="event-list event-details" style="display: none;">
                                            @foreach($eventType->events as $event)
                                                <li>
                                                    <strong>{{ $event->eventName }}</strong>
                                                    <div>
                                                        Description: {{ $event->description }} <br>
                                                        Date: {{ $event->date }} <br>
                                                        Time: {{ $event->time }}<br>
                                                        Location: {{ $event->location }}
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <p>No events available for this type.</p>
                                    @endif
                                </div>


                                <div class="d-flex border-top">
                                    <small class="flex-fill text-center border-end py-2"><i
                                            class="fa fa-user-tie text-primary me-2"></i>John Doe</small>
                                    <small class="flex-fill text-center py-2"><i class="fa fa-user text-primary me-2"></i>30
                                        Students</small>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p>No event types available.</p>
                @endif
            </div>
        </div>
    </div>
<!-- Courses End -->
<!-- Modal -->
<div class="modal fade" id="eventDetailsModal" tabindex="-1" role="dialog" aria-labelledby="eventDetailsModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="eventDetailsModalLabel">Event Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="eventDetailsModalBody">
        <!-- Event details content will be displayed here -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>



    <script>
        function toggleEventDetails(button) {
            // Find the next sibling element, which is the event details
            var eventDetails = button.nextElementSibling;

            // Toggle the visibility of event details
            eventDetails.style.display = (eventDetails.style.display === 'none' || eventDetails.style.display === '') ? 'block' : 'none';
        }

        function showEventDetails(event) {
            // Hide all event details
            var eventDetailsContainers = document.querySelectorAll('.event-details-container');
            eventDetailsContainers.forEach(function(container) {
                container.style.display = 'none';
            });

            // Show the selected event details
            var eventId = event.getAttribute('data-event-id');
            var eventDetailsContainer = document.getElementById('eventDetailsContainer_' + eventId);
            eventDetailsContainer.style.display = 'block';
        }
    </script>
    <script>
    function showEventDetailsModal(eventTypeName, eventCount, ...events) {
        var modalBody = document.getElementById('eventDetailsModalBody');
        var modalContent = '';

        if (eventCount > 0) {
            modalContent += '<ul class="event-list event-details">';
            events.forEach(function (event) {
                modalContent += '<li>';
                modalContent += '<strong>' + event.eventName + '</strong>';
                modalContent += '<div>';
                modalContent += 'Description: ' + event.description + '<br>';
                modalContent += 'Date: ' + event.date + '<br>';
                modalContent += 'Time: ' + event.time + '<br>';
                modalContent += 'Location: ' + event.location;
                modalContent += '</div>';
                modalContent += '</li>';
            });
            modalContent += '</ul>';
        } else {
            modalContent = '<p>No events available for ' + eventTypeName + '.</p>';
        }

        modalBody.innerHTML = modalContent;
        $('#eventDetailsModal').modal('show'); // Show the modal
    }
</script>

</body>
</html>

