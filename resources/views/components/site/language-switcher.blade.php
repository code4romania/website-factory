@props(['urls'])

<div class="text-sm">
    @foreach ($urls as $locale => $url)
        <a
            class="inline-flex px-3 py-2 rounded hover:bg-gray-100 focus:bg-gray-200 focus:outline-none"
            hreflang="{{ $locale }}"
            href="{{ $url }}">
            {{ config("translatable.locales.${locale}.name") }}
        </a>
    @endforeach
</div>
