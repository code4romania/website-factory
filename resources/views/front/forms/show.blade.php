@extends('front.layout')

@section('content')
    <form action="" method="post">
        @csrf

        <x-blocks :model="$form" class="mt-16 sm:mt-24 lg:mt-32" />

        <button>Submit</button>
    </form>
@endsection
