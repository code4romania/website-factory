@if ($title)
    <title>{{ $title }}</title>

    @unless(seo()->hasTag('og:title'))
        {{-- If an og:title tag is provided directly, it's included in the @foreach below --}}
        <meta property="og:title" content="{{ $title }}" />
    @endunless
@endif

@if ($description)
    <meta property="og:description" content="{{ $description }}" />
    <meta name="description" content="{{ $description }}" />
@endif

@if ($type)
    <meta property="og:type" content="{{ $type }}" />
@endif

@if ($site)
    <meta property="og:site_name" content="{{ $site }}">
@endif

@if ($image)
    <meta property="og:image" content="{{ $image }}" />
@endif

@if ($url)
    <meta property="og:url" content="{{ $url }}" />
    <link rel="canonical" href="{{ $url }}" />
@endif

@foreach (seo()->tags() as $tag)
    {!! $tag !!}
@endforeach

@foreach (seo()->extensions() as $extension)
    <x-dynamic-component :component="$extension" />
@endforeach

<link rel="icon" type="image/png" href="{{ favicon_url() }}">
