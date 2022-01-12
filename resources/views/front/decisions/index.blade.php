<x-layout>
    <header class="container relative my-16 space-y-4 sm:my-24 lg:my-32">
        <h1 class="text-3xl font-bold text-gray-900 md:text-4xl lg:text-5xl">
            {{ trans_choice('decision.label', 2) }}
        </h1>

        <div class="prose text-gray-500 max-w-prose sm:prose-lg lg:prose-xl">
            {{-- {!! $decision->description !!} --}}
        </div>
    </header>


    <div class="container divide-y divide-gray-200">
        @foreach ($decisions as $decision)
            <a
                href="{{ route('front.decisions.show', [
                    'locale' => app()->getLocale(),
                    'decision' => $decision,
                ]) }}"
                class="block py-4 space-y-2 hover:bg-gray-50 ">
                <div class="flex items-center justify-between">
                    <p class="font-semibold text-gray-900 truncate ">
                        {{ $decision->title }}
                    </p>

                    <div class="flex ml-2 shrink-0">
                        <p
                            class="inline-flex px-2 text-xs font-semibold leading-5 text-green-800 bg-green-100 rounded-full">
                            Hotărâre
                        </p>
                    </div>
                </div>

                <div class="sm:flex sm:justify-between">
                    <div class="space-y-2 text-sm text-gray-500 sm:flex sm:space-y-0 sm:space-x-6">
                        <p class="flex items-center">
                            <x-ri-calendar-event-fill class="shrink-0 mr-1.5 h-5 w-5 text-gray-400" />

                            <time
                                datetime="{{ $decision->created_at->toDateString() }}">{{ $decision->created_at->toDateString() }}</time>
                        </p>
                        <p class="flex items-center">
                            <!-- Heroicon name: solid/location-marker -->
                            <svg class="shrink-0 mr-1.5 h-5 w-5 text-gray-400"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                    clip-rule="evenodd" />
                            </svg>
                            Remote
                        </p>
                    </div>

                    <div class="flex items-center mt-2 text-sm text-gray-500 sm:mt-0">
                        <x-ri-calendar-event-fill class="shrink-0 mr-1.5 h-5 w-5 text-gray-400" />

                        <time
                            datetime="{{ $decision->created_at->toDateString() }}">{{ $decision->created_at->toDateString() }}</time>
                    </div>
                </div>

                <div class="prose-sm prose">
                    <p>{{ $decision->description }}</p>
                </div>

            </a>
        @endforeach


        {{ $decisions->links() }}

    </div>
</x-layout>
