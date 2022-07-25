@props(['form'])

<div {{ $attributes }}>

    <form
        method="post"
        action="{{ localized_route('front.forms.submit', ['form' => $form]) }}"
        x-data="form"
        @submit.prevent="submit">

        <template x-if="success">
            <div class="p-4 rounded-md bg-green-50">
                <div class="flex">
                    <x-ri-mail-send-fill class="w-5 h-5 text-green-400 shrink-0" />

                    <p class="ml-3 text-sm font-medium text-green-800" x-text="message"></p>
                </div>
            </div>
        </template>

        <div x-show="!success">
            <x-blocks :model="$form" prefix="form" :container="false" />

            <div x-show="message || errorList.length > 0" class="p-4 rounded-md bg-red-50">
                <div class="flex">
                    <x-ri-alert-fill class="w-5 h-5 text-red-400 shrink-0" />

                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-red-800">
                            @lang('validation.error.generic')
                        </h3>

                        <ul class="pl-5 mt-2 space-y-1 text-sm text-red-700 list-disc">
                            <template x-for="error in errorList">
                                <li x-text="error"></li>
                            </template>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="flex mt-8 lg:mt-12">
                <x-button
                    ::disabled="processing"
                    type="submit"
                    class="items-center justify-center block w-full font-semibold text-white border border-transparent sm:w-auto sm:inline-block bg-primary focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary disabled:opacity-50"
                    size="lg">
                    @lang('form.action.submit')
                </x-button>
            </div>
        </div>
    </form>
</div>
