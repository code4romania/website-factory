<div class="grid gap-8 lg:grid-cols-3">
    <div>
        <x-blocks._title :title="$title" />

        <div class="prose text-gray-500 prose-blue md:prose-lg max-w-prose">
            {!! $html !!}
        </div>
    </div>

    <ul class="grid lg:col-span-2 sm:grid-cols-2 gap-x-6 gap-y-8 lg:gap-y-12 lg:gap-x-8">
        @foreach ($people as $person)
            <li class="space-y-4">
                @if ($show_images && $person->hasMedia('image'))
                    <a
                        href="{{ $person->url }}"
                        title="{{ __('person.view_profile') }}"
                        class="block overflow-hidden transition-shadow duration-150 rounded-lg shadow-lg aspect-w-3 aspect-h-2 hover:shadow-xl">
                        <x-media.image
                            :src="$person->getMediaUrl('image', 'thumb')"
                            class="object-cover" />
                    </a>
                @endif

                <div class="text-lg">
                    <a
                        href="{{ $person->url }}"
                        title="{{ __('person.view_profile') }}"
                        class="flex justify-between hover:underline">
                        <h3 class="font-semibold text-gray-900">
                            {{ $person->name }}
                        </h3>

                        <x-ri-arrow-right-line class="w-5 h-5 ml-2 shrink-0" />
                    </a>
                    <p class="font-medium text-primary">{{ $person->title }}</p>
                </div>

                <div class="prose text-gray-500 md:prose-lg">
                    {!! $person->description !!}
                </div>

                <x-social-media-links :links="$person->social" />
            </li>
        @endforeach
    </ul>

</div>
