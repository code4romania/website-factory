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

    @if (is_internal_site())
        <style>
            * {
                border-radius: 0 !important;
            }
        </style>
    @endif

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

    <main id="content" class="flex-1 mb-12 lg:mb-16">
        {{ $slot }}
    </main>

    <x-site.footer />

    <x-site.cookie-notice />

    {!! $footerHtml !!}
</body>

</html>
