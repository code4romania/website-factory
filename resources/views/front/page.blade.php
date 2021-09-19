@extends('front.layout')

@section('content')
    <header class="container my-24">
        <h1 class="block mt-2 text-3xl font-extrabold tracking-tight text-gray-900 sm:text-4xl">
            {{ $page->title }}
        </h1>
    </header>

    <x-blocks :model="$page" class="test" />
@endsection
