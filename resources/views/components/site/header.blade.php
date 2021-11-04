<header class="relative text-white bg-teal-700">
    <nav class="container flex justify-between py-4">
        <a href="{{ route('front.pages.index') }}" class="inline-flex">
            {{-- <x-icon-logo class="w-auto h-8" /> --}}

            <img src="{{ $logo }}" alt="" class="h-8">
        </a>




        @if ($alternateUrls)
            <div>
                @foreach ($alternateUrls as $locale => $url)
                    <a
                        class="inline-flex p-2 text-sm rounded"
                        title="{{-- TODO --}}"
                        hreflang="{{ $locale }}"
                        href="{{ $url }}">
                        {{ strtoupper($locale) }}
                    </a>
                @endforeach
            </div>
        @endif
    </nav>
</header>
