@if ($title)
    <h1 class="mb-8 text-xl font-semibold">{{ $title }}</h1>
@endif

<div @class(['grid gap-x-8 gap-y-16', $columns])>
    @foreach ($items as $item)
        <div>
            <dt>
                <div class="flex items-center justify-center w-12 h-12 text-white bg-teal-500 rounded-md">
                    <svg class="w-6 h-6" x-description="Heroicon name: outline/globe-alt"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9">
                        </path>
                    </svg>
                </div>
                <p class="mt-5 text-lg font-medium leading-6 text-gray-900">
                    {{ $item->translatedInput('title') }}
                </p>
            </dt>
            <dd class="mt-2 prose prose-blue">
                {!! $item->translatedInput('text') !!}
            </dd>
        </div>
    @endforeach
</div>
