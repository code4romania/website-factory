<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ text_direction() }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @vite(['resources/css/public.css', 'resources/js/public.js'])
    <link rel="stylesheet" href="{{ route('front.theme') }}">
    @stack('preload')
    @stack('scripts')

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>

    @if (is_internal_site())
        <style>
            * {
                border-radius: 0 !important;
            }
        </style>
    @endif

    <x-site.meta />

    {!! $headerHtml !!}
</head>

<body class="flex flex-col min-h-screen antialiased">
    <x-site.skip-to-content />

    <x-site.header />

    <x-site.partners />

    <x-site.notice />

    <main id="content" class="flex-1 mb-12 lg:mb-16">
        {{ $slot }}
    </main>

    <x-site.footer />

    <x-site.cookie-notice />

    {!! $footerHtml !!}
</body>

</html>
