<footer class="relative mt-16 bg-gray-50 sm:mt-24 lg:mt-32 bg-primary">
    <div class="container py-12 lg:py-16">
        <div class="grid gap-8 xl:grid-cols-3">
            <div>
                {{-- TODO --}}
            </div>

            <nav class="xl:col-span-2">
                <ul @class([
                    'grid gap-8 gap-y-16 sm:grid-cols-2',
                    'md:grid-cols-3' => $menu->count() % 3 === 0,
                    'md:grid-cols-4' => $menu->count() % 2 === 0 && $menu->count() % 3 !== 0,
                ])>
                    @foreach ($menu as $item)
                        <li class="space-y-4">
                            <x-dynamic-component
                                class="text-sm font-semibold tracking-wider text-white uppercase hover:text-white/60 focus-visible:text-white/60"
                                :component="$item->component"
                                :item="$item" />

                            @if ($item->children->count())
                                <ul class="space-y-4">
                                    @foreach ($item->children as $item)
                                        <li>
                                            <x-dynamic-component
                                                class="text-white/60 hover:text-white focus-visible:text-white"
                                                :component="$item->component"
                                                :item="$item" />
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </nav>
        </div>

        <div class="pt-8 mt-8 border-t border-gray-200 md:flex md:items-center md:justify-between">
            <x-social-media-links :links="$social" class="md:order-2" />

            <p class="mt-8 text-base text-gray-400 md:mt-0 md:order-1">
                &copy; {{ date('Y') }} {{ $title }}
            </p>
        </div>
    </div>
</footer>
