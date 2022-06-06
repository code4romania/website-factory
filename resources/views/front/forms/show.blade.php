<x-layout>
    <header class="container relative my-16 sm:my-24 lg:my-32">
        <h1 class="text-2xl font-bold text-gray-900 md:text-3xl lg:text-4xl">
            {{ $form->title }}
        </h1>

        <div class="mt-4 prose text-gray-500 max-w-prose md:prose-lg">
            {!! $form->description !!}
        </div>

        <div class="mt-16 border-b border-gray-300"></div>
    </header>

    <x-form :form="$form" class="max-w-6xl mx-auto mt-16 sm:mt-24 lg:mt-32" />
</x-layout>
