@extends('front.layout')

@section('content')
    <header class="container relative my-16 sm:my-24 lg:my-32">
        <h1 class="text-2xl font-bold text-gray-900 md:text-3xl lg:text-4xl">
            {{ $form->title }}
        </h1>

        <div class="mt-4 prose text-gray-500 max-w-prose md:prose-lg">
            {!! $form->description !!}
        </div>

        <div class="mt-16 border-b border-gray-300"></div>
    </header>

    <div class="max-w-6xl mx-auto mt-16 sm:mt-24 lg:mt-32">
        @if (session()->has('success'))
            <div class="p-4 rounded-md bg-green-50">
                <div class="flex">
                    <x-ri-mail-send-fill class="flex-shrink-0 w-5 h-5 text-green-400" />

                    <p class="ml-3 text-sm font-medium text-green-800">
                        {{ session()->get('success') }}
                    </p>
                </div>
            </div>
        @else
            <form action="" method="post">
                <x-blocks :model="$form" />

                <div class="container flex mt-8 lg:mt-12">
                    @csrf

                    <button
                        type="submit"
                        class="items-center justify-center block w-full px-5 py-3 text-base font-medium text-white bg-teal-600 border border-transparent rounded-md shadow-sm sm:w-auto sm:inline-block hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">
                        Submit
                    </button>
                </div>
            </form>
        @endif
    </div>
@endsection
