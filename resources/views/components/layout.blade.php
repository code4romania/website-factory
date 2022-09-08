<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="{{ asset(mix('assets/public.css')) }}">
    <link rel="stylesheet" href="{{ route('front.theme') }}">

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>

    @stack('preload')

    {{-- Scripts --}}
    <script src="{{ asset(mix('assets/public.js')) }}" defer></script>
    @stack('scripts')

    <x-site.meta />

    {!! $headerHtml !!}
</head>

<body class="flex flex-col min-h-screen antialiased">
    <x-site.skip-to-content />

    <x-site.header />

    <x-site.partners />

    <x-site.notice />

    <main id="content" class="flex-1 mb-16 sm:mb-24 lg:mb-32">
        {{ $slot }}
    </main>

    <x-site.footer />

    <x-site.cookie-notice />

    {!! $footerHtml !!}
</body>

</html>
