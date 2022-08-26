<aside class="bg-gray-100">
    <div class="container py-3">
        <a
            href="https://www.code4.ro"
            target="_blank"
            rel="noopener"
            class="flex flex-wrap items-center gap-x-6 gap-y-3 sm:flex-nowrap hover:text-blue-600 focus:text-blue-600 focus:outline-0 hover:underline focus:underline">
            <x-icon-code4 class="h-6 shrink-0" />

            <p class="text-sm">
                @lang('banner.byline', [
                    'edition' => __('banner.edition.' . config('website-factory.edition')),
                ])
            </p>
        </a>
    </div>
</aside>
