@extends('front.layout')

@section('content')
    <header
        class="container relative flex flex-col items-center justify-center my-16 text-center sm:my-24 lg:my-32">
        <h1 class="text-2xl font-bold text-gray-900 md:text-3xl lg:text-4xl">
            {{ $page->title }}
        </h1>

        <div class="mt-4 prose text-gray-500 max-w-prose md:prose-lg">
            {!! $page->description !!}
        </div>

        <div class="w-full mt-16 border-b border-gray-300"></div>
    </header>

    <x-blocks :model="$page" class="test" />
@endsection
