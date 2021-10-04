@if ($title)
    <h1 class="text-xl font-semibold">{{ $title }}</h1>
@endif

<div class="prose prose-blue">
    {!! $html !!}
</div>
