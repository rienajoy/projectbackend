<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Event</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="{{ asset('css/index.css') }}" rel="stylesheet">
    
</head>

    <div class="container">
        <div class="row align-items-center">
            <!-- Content on the left side -->
            <div class="welcome">
                <div style="text-align: center;">
                    <h1 data-aos="fade-right" class="mx-auto">WELCOME TO EVENT</h1>
                    <p class="mb-5" data-aos="fade-right" data-aos-delay="100">Elevate Your Productivity: Simplify Your
                        Life with <br>Our To-Do List System – Your Key to Achieving More, Stressing Less!</p>
                    <a href="#">Login</a>
                    <a href="#">Register</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Main JS Files -->
    <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>
    <!-- Template Main JS File -->
    <script src="{{ asset('assets/js/main.js') }}"></script>
</body>

</html>

