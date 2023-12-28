<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Event</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    
</head>

<body>
    <div class="container register-container">
        <form action="/register" method="post">
            @csrf
            <h1>User Registration</h1>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <label for="username">Username:</label>
            <input type="text" name="username" value="{{ old('username') }}" required>

            <label for="fname">First Name:</label>
            <input type="text" name="fname" value="{{ old('fname') }}" required>

            <label for="lname">Last Name:</label>
            <input type="text" name="lname" value="{{ old('lname') }}" required>

            <label for="password">Password:</label>
            <input type="password" name="password" required>

            <label for="email">Email:</label>
            <input type="email" name="email" value="{{ old('email') }}" required>

            <label for="org_code">Organization Code:</label>
            <input type="text" name="org_code" value="{{ old('org_code') }}" required>
            
            <button type="submit">Register</button>

            @if ($errors->has('org_code'))
                <p class="error-message">{{ $errors->first('org_code') }}</p>
            @endif

        </form>
    </div>
</body>

</html>
