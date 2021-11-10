@extends('front.layout')

@section('content')

    <header class="container relative my-16 space-y-4 sm:my-24 lg:my-32">
        <h1 class="text-3xl font-extrabold text-gray-900 md:text-4xl lg:text-5xl">
            {{ trans_choice('post.label', 2) }}

        </h1>

        <div class="prose text-gray-500 max-w-prose sm:prose-lg lg:prose-xl">
            {{-- {!! $post->description !!} --}}
        </div>
    </header>


    <div class="container">
        <div class="grid gap-8 mb-8 md:grid-cols-2 lg:grid-cols-4">
            @foreach ($posts as $post)
                <article class="flex flex-col overflow-hidden rounded-lg shadow-lg">
                    <a href="{{ $post->url }}" class="flex-shrink-0">
                        <img class="object-cover w-full h-48"
                            src="https://images.unsplash.com/photo-1547586696-ea22b4d4235d?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=crop&amp;w=1679&amp;q=80"
                            alt="">
                    </a>
                    <div class="flex-1 p-6 space-y-2 bg-white">
                        {{-- TODO: categories --}}

                        <a href="{{ $post->url }}" class="block space-y-3">
                            <h1 class="text-xl font-semibold text-gray-900">
                                {{ $post->title }}
                            </h1>
                            <p class="text-gray-500">
                                {{ $post->description }}
                            </p>
                        </a>
                    </div>
                </article>
            @endforeach
        </div>

        {{ $posts->links() }}
    </div>
@endsection
