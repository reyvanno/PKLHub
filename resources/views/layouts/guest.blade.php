<!DOCTYPE html>
<html lang="en">

<head>

    <title>PKLHub</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>




<body class="min-h-screen relative flex items-center justify-center overflow-hidden">

    <!-- Background -->
    <img src="{{ asset('images/background-hero.png') }}" class="absolute inset-0 w-full h-full object-cover">

    <!-- Overlay -->
    <div class="absolute inset-0 bg-black/60"></div>


    <!-- Content -->
    <div class="relative w-full max-w-md">

        {{ $slot }}

    </div>


</body>

</html>
