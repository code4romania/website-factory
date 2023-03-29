<div class="space-y-12">
    <div class="gap-5 sm:gap-4 md:max-w-xl lg:max-w-3xl xl:max-w-none">
        <x-blocks._title :title="$title" />

        <div class="prose text-gray-500 prose-blue md:prose-lg max-w-prose">
            {!! $html !!}
        </div>
    </div>

    <ul
        class="grid lg:col-span-2 sm:grid-cols-2 gap-x-6 gap-y-8 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6 lg:gap-y-12 lg:gap-x-8">
        @foreach ($people as $person)
            <li class="space-y-4">
                @if ($show_images && $person->hasMedia('image'))
                    <a
                        href="{{ $person->url }}"
                        title="{{ __('person.action.view') }}"
                        class="block overflow-hidden transition-shadow duration-150 rounded-lg shadow-lg aspect-w-1 aspect-h-1 hover:shadow-xl"
                    >
                        <x-media.image
                            :src="$person->getThumbnailUrl(large: true)"
                            class="object-cover"
                            :preload="$shouldPreload()"
                        />
                    </a>
                @endif

                <div class="text-lg">
                    <a
                        href="{{ $person->url }}"
                        title="{{ __('person.action.view') }}"
                        class="flex items-center justify-between gap-2 leading-tight hover:underline"
                    >
                        <h3 class="font-semibold text-gray-900">
                            {{ $person->name }}
                        </h3>

                        <x-ri-arrow-right-line class="w-5 h-5 shrink-0" />
                    </a>

                    <p class="text-sm font-medium text-primary">{{ $person->title }}</p>
                </div>

                <div class="prose text-gray-500 line-clamp-3">
                    {!! $person->description !!}
                </div>

                <x-social-media-links :links="$person->social" />
            </li>
        @endforeach
    </ul>

</div>
