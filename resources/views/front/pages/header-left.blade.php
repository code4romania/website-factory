@extends('front.layout')

@section('content')
    <header class="container relative my-16 space-y-4 sm:my-24 lg:my-32">
        <h1 class="text-3xl font-extrabold text-gray-900 md:text-4xl lg:text-5xl">
            {{ $page->title }}
        </h1>

        <div class="prose text-gray-500 max-w-prose sm:prose-lg lg:prose-xl">
            {!! $page->description !!}
        </div>
    </header>

    <x-blocks :model="$page" class="test" />
@endsection
