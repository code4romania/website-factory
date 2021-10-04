@if ($title)
    <h1 class="mb-2 text-xl font-semibold">{{ $title }}</h1>
@endif

<div class="{{ $aspectRatio }}">
    {!! $html !!}
</div>
