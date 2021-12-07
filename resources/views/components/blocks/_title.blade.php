@props([
    'title' => null,
])

@if ($title)
    <h1 class="mb-8 text-xl font-bold text-gray-900 sm:text-2xl md:text-3xl">
        {{ $title }}
    </h1>
@endif
