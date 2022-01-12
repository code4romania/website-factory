<footer class="relative mt-16 bg-gray-50 sm:mt-24 lg:mt-32">
    <div class="container py-12 lg:py-16">
        <div class="grid gap-8 xl:grid-cols-3">
            <nav class="xl:col-span-2">
                <ul class="grid grid-cols-2 gap-10 md:grid-cols-4">
                    @foreach ($menu as $item)
                        <li class="space-y-4">
                            <x-dynamic-component
                                class="text-sm font-semibold tracking-wider text-gray-400 uppercase hover:text-gray-900"
                                :component="$item->component"
                                :item="$item" />

                            @if ($item->children->count())
                                <ul class="space-y-4">
                                    @foreach ($item->children as $item)
                                        <li>
                                            <x-dynamic-component
                                                class="text-gray-500 hover:text-gray-900"
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

            <div>
                <h3 class="text-sm font-semibold tracking-wider text-gray-400 uppercase">
                    Subscribe to our newsletter
                </h3>
                <p class="mt-4 text-base text-gray-100">
                    The latest news, articles, and resources, sent to your inbox weekly.
                </p>
                <form class="mt-4 sm:flex sm:max-w-md">
                    <label for="email-address" class="sr-only">Email address</label>
                    <input type="email" name="email-address" id="email-address" autocomplete="email" required
                        class="w-full min-w-0 px-4 py-2 text-base text-gray-900 placeholder-gray-500 bg-white border border-transparent rounded-md appearance-none focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white focus:border-white focus:placeholder-gray-400"
                        placeholder="Enter your email">
                    <div class="mt-3 rounded-md sm:mt-0 sm:ml-3 sm:shrink-0">
                        <button type="submit"
                            class="flex items-center justify-center w-full px-4 py-2 text-base font-medium text-white bg-primary opacity-90 border border-transparent rounded-md hover:opacity-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-50 focus:ring-primary">
                            Subscribe
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="mt-8 border-t border-gray-200 pt-8 md:flex md:items-center md:justify-between">
            <p class="mt-8 text-base text-gray-400 md:mt-0 md:order-1">
                &copy; {{ date('Y') }} {{ $title }}
            </p>
        </div>
    </div>
</footer>
