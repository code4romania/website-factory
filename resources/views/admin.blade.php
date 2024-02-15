<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ text_direction() }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" type="image/png" href="{{ favicon_url() }}">

    @routes

    @vite(['resources/css/admin.css', 'resources/js/admin.js'])
</head>

<body class="min-h-screen antialiased bg-gray-100">
    @inertia
</body>

</html>
