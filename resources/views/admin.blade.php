<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="{{ asset(mix('admin.css', 'assets')) }}">

    {{-- Scripts --}}
    <script src="{{ asset(mix('admin.js', 'assets')) }}" defer></script>

    @routes
</head>

<body class="antialiased">
    @inertia
</body>

</html>
