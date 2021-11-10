<header class="relative text-white bg-teal-700">
    <div class="container lg:divide-teal-600 lg:divide-y">
        <div class="relative flex items-center justify-between py-4">
            <a href="{{ route('front.pages.index') }}" class="inline-flex">
                <img src="{{ $logo }}" alt="" class="h-10">
            </a>

            <div>
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
            </div>
        </div>
    </div>
</header>
