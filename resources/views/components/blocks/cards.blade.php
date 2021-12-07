<x-blocks._title :title="$title" />

<div @class(['grid gap-x-8 gap-y-16', $columns])>
    @foreach ($items as $item)
        <div @class([
            'bg-white shadow-lg rounded-lg overflow-hidden flex flex-col' => $shadow,
        ])>
            <div
                @class([
                    'px-4 py-5 sm:p-6 flex-1' => $shadow,
                ])>
                <dt>
                    @if ($item->input('icon'))
                        <div class="flex items-center justify-center w-12 h-12 text-white bg-teal-500 rounded-md">
                            {{ svg("ri-{$item->input('icon')}", 'w-6 h-6') }}
                        </div>
                    @endif

                    <p class="mt-5 text-lg font-semibold leading-6 text-gray-900">
                        {{ $item->translatedInput('title') }}
                    </p>
                </dt>
                <dd class="mt-2 prose prose-blue">
                    {!! $item->translatedInput('text') !!}
                </dd>

            </div>

            @if ($item->translatedInput('button_url') && $item->translatedInput('button_text'))
                <div
                    @class([
                        'text-sm',
                        'bg-gray-50 px-4 py-4 sm:px-6' => $shadow,
                        'mt-4' => !$shadow,
                    ])>
                    <a
                        href="{{ $item->translatedInput('button_url') }}"
                        class="flex items-center font-semibold text-teal-600 hover:underline">
                        {{ $item->translatedInput('button_text') }}

                        <x-ri-arrow-right-line class="flex-shrink-0 w-5 h-5 ml-2" />
                    </a>
                </div>
            @endif
        </div>
    @endforeach
</div>
