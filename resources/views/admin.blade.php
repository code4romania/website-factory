<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="{{ asset(mix('assets/admin.css')) }}">

    {{-- Scripts --}}
    <script src="{{ asset(mix('assets/admin.js')) }}" defer></script>

    <link rel="icon" type="image/png" href="{{ favicon_url() }}">

    @routes
</head>

<body class="min-h-screen antialiased bg-gray-100">
    @inertia
</body>

</html>
