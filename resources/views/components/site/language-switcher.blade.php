<div class="bg-gray-50">
    <nav class="container flex flex-wrap justify-end text-xs md:text-sm">
        @foreach ($alternateUrls as $locale => $url)
            @if (app()->getLocale() === $locale)
                <span
                    class="inline-flex sm:px-3 sm:py-2 px-2.5 py-1.5 font-medium bg-primary/10 text-primary focus:outline-none">
                    {{ data_get(locales(), "$locale.name") }}
                </span>
            @else
                <a
                    class="inline-flex sm:px-3 sm:py-2 px-2.5 py-1.5 font-medium focus:outline-none hover:bg-gray-100 focus:bg-gray-200"
                    hreflang="{{ $locale }}"
                    href="{{ $url }}">
                    {{ data_get(locales(), "$locale.name") }}
                </a>
            @endif
        @endforeach
    </nav>
</div>
