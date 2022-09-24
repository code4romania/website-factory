<div class="relative overflow-hidden shadow-xl bg-primary rounded-xl">
    <div class="px-6 py-10 sm:p-16 xl:p-20">
        <div class="max-w-2xl mx-auto">
            <x-blocks._title :title="$title" class="text-white" />

            <div class="leading-7 prose prose-lg text-white max-w-prose">
                {!! $html !!}
            </div>

            @if ($button_url && $button_text)
                <a href="{{ $button_url }}"
                    class="items-center block w-full px-5 py-3 mt-8 text-base font-medium text-center text-gray-800 bg-white border border-transparent rounded-md shadow sm:w-auto sm:inline-block">
                    {{ $button_text }}
                </a>
            @endif
        </div>
    </div>
</div>
