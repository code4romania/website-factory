<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="{{ asset(mix('admin.css', 'assets')) }}">

    {{-- Scripts --}}
    <script src="{{ asset(mix('admin.js', 'assets')) }}" defer></script>

    <link rel="icon" type="image/svg+xml" href="{{ asset(mix('images/favicon.svg', 'assets')) }}">
    <link rel="icon" type="image/png" href="{{ asset(mix('images/favicon.png', 'assets')) }}">

    @routes
</head>

<body class="min-h-screen antialiased bg-gray-100">
    @inertia
</body>

</html>
