@if ($title)
    <h1 class="text-xl font-semibold sm:text-2xl">{{ $title }}</h1>
@endif

<div class="prose prose-blue md:prose-lg">
    {!! $html !!}
</div>
