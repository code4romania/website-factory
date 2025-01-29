<aside class="bg-gray-100">
    <div class="container flex gap-3 py-3">
        <a
            href="https://www.code4.ro"
            target="_blank"
            rel="noopener"
            class="flex items-center max-w-2xl text-sm hover:text-blue-600 focus:text-blue-600 focus:outline-0 hover:underline focus:underline">
            <x-icon-code4 class="h-6 sm:h-8 shrink-0" />
        </a>
        <div class="flex flex-col text-sm">
            <a
                class="hover:text-blue-600 focus:text-blue-600 focus:outline-0 hover:underline focus:underline"
                href="https://www.code4.ro"
                target="_blank"
                rel="noopener">
                {{ $text }}
            </a>

            @if ($isExternalSite)
                <div class="flex gap-1 leading-relaxed">
                    <a
                        class="font-semibold hover:underline focus:underline"
                        href="https://www.code4.ro/ro/nota-de-informare-website-factory-scoli"
                        target="_blank"
                        rel="noopener">
                        @lang('banner.disclaimer')
                    </a>
                    <span class="text-gray-500" aria-hidden="true">|</span>
                    <a
                        class="font-semibold hover:underline focus:underline"
                        href="https://www.code4.ro/ro/forms/raporteaza-o-problema-cu-website-factory"
                        target="_blank"
                        rel="noopener">
                        @lang('banner.report_issue')
                    </a>
                </div>
            @endif
        </div>
    </div>
</aside>
