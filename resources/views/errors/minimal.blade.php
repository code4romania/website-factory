<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex">

    <link rel="stylesheet" href="{{ asset(mix('assets/public.css')) }}">

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>

    @stack('preload')

    {{-- Scripts --}}
    <script src="{{ asset(mix('assets/public.js')) }}" defer></script>
    @stack('scripts')

    <title>@yield('title')</title>
</head>

<body class="h-screen antialiased">
    <div class="min-h-full px-4 py-16 bg-white sm:px-6 sm:py-24 md:grid md:place-items-center lg:px-8">
        <div class="mx-auto max-w-max">
            <main class="sm:flex">
                <p class="text-4xl font-extrabold text-red-600/30 sm:text-5xl">@yield('code')</p>
                <div class="sm:ml-6">
                    <div class="sm:border-l sm:border-gray-200 sm:pl-6">
                        <h1 class="text-4xl font-bold text-gray-900 sm:text-5xl">
                            @yield('title')
                        </h1>
                        <p class="mt-1 text-base text-gray-500">
                            @yield('message')
                        </p>
                    </div>

                    <div class="flex mt-10 space-x-3 sm:border-l sm:border-transparent sm:pl-6">
                        <a
                            href="{{ localized_route('front.pages.index') }}"
                            class="flex items-center justify-center w-full px-4 py-2 text-sm font-semibold text-white bg-red-600 border border-transparent sm:w-auto sm:inline-block focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-600">
                            @lang('app.action.backHome')
                        </a>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>

</html>
