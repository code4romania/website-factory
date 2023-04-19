<footer class="relative bg-primary">
    <div class="container py-12 lg:py-16">
        <div class="grid gap-8 xl:grid-cols-3">
            <div>
                {!! $footer !!}
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
                                :item="$item"
                            />

                            @if ($item->children->count())
                                <ul class="space-y-4">
                                    @foreach ($item->children as $item)
                                        <li>
                                            <x-dynamic-component
                                                class="text-white/60 hover:text-white focus-visible:text-white"
                                                :component="$item->component"
                                                :item="$item"
                                            />
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </nav>
        </div>

        <div
            class="flex flex-col gap-4 pt-8 mt-8 border-t border-gray-200 md:flex-row md:items-center md:justify-between md:flex-wrap">

            <x-site.banner-government
                :text="$banner()"
                class="w-full"
            />

            <x-social-media-links
                :links="$social"
                class="text-white md:order-2"
            />

            <p class="text-white/60 md:mt-0 md:order-1">
                &copy; {{ date('Y') }} {{ $title }}
            </p>
        </div>
    </div>
</footer>
