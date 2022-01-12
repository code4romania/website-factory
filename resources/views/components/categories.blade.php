@props(['categories'])

<div {{ $attributes->class('flex flex-wrap text-primary space-x-1') }}>
    @foreach ($categories as $category)
        <a href="{{ $category->url }}" class="hover:underline">{{ $category->title }}</a>

        @if (!$loop->last)
            ,
        @endif
    @endforeach
</div>
