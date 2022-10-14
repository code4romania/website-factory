@props([
    'privacyPolicyUrl' => null,
])

<div x-data="{
    showCookieNotice: $persist(true),
    close() {
        this.showCookieNotice = false;
    }
}" x-cloak>
    <div
        x-show="showCookieNotice"
        class="fixed inset-0 z-50 flex items-end px-4 py-6 pointer-events-none sm:p-6">
        <div class="flex flex-col items-center w-full space-y-4 sm:items-end">
            <div
                class="flex items-start w-full max-w-2xl gap-2 p-4 overflow-hidden bg-white shadow-lg pointer-events-auto ring-1 ring-black ring-opacity-5">
                <div class="flex-1 w-0">
                    <p class="text-sm font-medium text-gray-900">@lang('cookie_notice.title')</p>
                    <p class="mt-1 text-sm text-gray-500">@lang('cookie_notice.text')</p>
                    <div class="flex gap-4 mt-3">
                        <button
                            type="button"
                            @click.prevent="close"
                            class="text-sm font-medium text-primary focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">@lang('cookie_notice.agree')</button>

                        @if ($privacyPolicyUrl)
                            <a
                                href="{{ $privacyPolicyUrl }}"
                                class="text-sm font-medium text-gray-700 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">@lang('cookie_notice.info')</a>
                        @endif
                    </div>
                </div>

                <button
                    type="button"
                    @click.prevent="close"
                    class="inline-flex text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary shrink-0">
                    <span class="sr-only">@lang('cookie_notice.clos3')</span>

                    <x-ri-close-line class="w-5 h-5" />
                </button>
            </div>
        </div>
    </div>
</div>
