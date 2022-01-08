<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="{{ mix('assets/admin.css') }}">

    {{-- Scripts --}}
    <script src="{{ mix('assets/admin.js') }}" defer></script>

    @routes
</head>

<body class="antialiased">
    @inertia
</body>

</html>
