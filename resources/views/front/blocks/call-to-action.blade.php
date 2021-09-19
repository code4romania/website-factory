<div class="bg-teal-50">
    <div @class([
        'gap-8 px-4 py-12 mx-auto max-w-7xl sm:px-6',
        'lg:py-24 lg:px-8 lg:flex lg:items-center lg:justify-between' => $block->checkbox('fullwidth') ])
    >
        <div class="space-y-3">
            <h2 class="text-3xl font-extrabold tracking-tight text-teal-600 md:text-4xl">
                {{ $block->translatedInput('title') }}
            </h2>

            <div class="prose prose-lg max-w-none">
                {!! $block->translatedInput('text') !!}
            </div>
        </div>

        <div class="flex mt-8 lg:mt-0 lg:flex-shrink-0">
            <a href="#"
                class="inline-flex items-center justify-center px-5 py-3 text-base font-medium text-white bg-teal-600 border border-transparent rounded-md shadow hover:bg-teal-700">
                Call to action button
            </a>
        </div>
    </div>
</div>
