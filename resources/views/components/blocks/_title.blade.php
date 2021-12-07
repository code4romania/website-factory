@props([
    'title' => null,
])

@if ($title)
    <h1 {{ $attributes->merge(['class' => 'mb-8 text-2xl font-bold text-gray-900 sm:text-3xl md:text-4xl']) }}>
        {{ $title }}
    </h1>
@endif
