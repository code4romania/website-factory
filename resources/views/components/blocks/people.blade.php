<div class="grid gap-8 lg:grid-cols-3">
    <div>
        <x-blocks._title :title="$title" />

        <div class="prose text-gray-500 prose-blue md:prose-lg max-w-prose">
            {!! $html !!}
        </div>
    </div>

    <ul class="grid lg:col-span-2 sm:grid-cols-2 gap-x-6 gap-y-8 lg:gap-y-12 lg:gap-x-8">
        @foreach ($people as $person)
            <li>
                @if ($show_images && $person->hasMedia('image'))
                    <div class="mb-4 overflow-hidden rounded-lg shadow-lg aspect-w-3 aspect-h-2">
                        <x-media.image
                            :src="$person->getMediaUrl('image', 'thumb')"
                            class="object-cover" />
                    </div>
                @endif

                <h3 class="text-lg font-semibold text-gray-900">{{ $person->name }}</h3>
                <p class="text-lg font-medium text-primary">{{ $person->title }}</p>

                <div class="mt-4 prose text-gray-500 prose-teal md:prose-lg">
                    {!! $person->description !!}
                </div>

                <a href="{{ $person->url }}"
                    class="flex items-center mt-4 font-semibold text-primary hover:underline">
                    Profil
                    <x-ri-arrow-right-line class="w-5 h-5 ml-2 shrink-0" />
                </a>
            </li>
        @endforeach
    </ul>

</div>
