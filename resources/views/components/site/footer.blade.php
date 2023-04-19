<x-site.banner :text="$banner()" />

<footer class="relative bg-gray-50">
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
                                class="text-sm font-semibold tracking-wider text-gray-400 uppercase hover:text-gray-900"
                                :component="$item->component"
                                :item="$item"
                            />

                            @if ($item->children->count())
                                <ul class="space-y-4">
                                    @foreach ($item->children as $item)
                                        <li>
                                            <x-dynamic-component
                                                class="text-gray-500 hover:text-gray-900"
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

        <div class="pt-8 mt-8 border-t border-gray-200 md:flex md:items-center md:justify-between">
            <x-social-media-links
                :links="$social"
                class="text-gray-400 md:order-2"
            />

            <p class="mt-8 text-base text-gray-400 md:mt-0 md:order-1">
                &copy; {{ date('Y') }} {{ $title }}.
            </p>
        </div>
    </div>
</footer>
