@props([
    'currency' => 'RON',
    'block',
])

<form
    {{ $attributes->merge([
        'action' => $action,
        'method' => 'post',
        'class' => 'grid sm:grid-cols-2 gap-6 items-start px-4 py-10 bg-gray-50 sm:px-6 md:px-8',
        'x-data' => 'form',
        '@submit.prevent' => 'submit',
    ]) }}>
    @csrf

    <label>
        <div class="flex mb-1 text-sm font-semibold">@lang('donation.field.first_name')</div>
        <input
            border-inherit
            class="block w-full border-inherit focus:ring-primary focus:border-primary sm:text-sm"
            type="text"
            name="first_name"
            value="{{ old('first_name') }}"
            autocomplete="given-name"
            x-model="form.first_name"
            x-init="initializeField"
            required>

        <x-blocks.form._error name="first_name" />
    </label>

    <label>
        <div class="flex mb-1 text-sm font-semibold">@lang('donation.field.last_name')</div>
        <input
            class="block w-full border-inherit focus:ring-primary focus:border-primary sm:text-sm"
            type="text"
            name="last_name"
            value="{{ old('last_name') }}"
            autocomplete="family-name"
            x-model="form.last_name"
            x-init="initializeField"
            required>

        <x-blocks.form._error name="last_name" />
    </label>

    <label>
        <div class="flex mb-1 text-sm font-semibold">@lang('donation.field.email')</div>
        <input
            class="block w-full border-inherit focus:ring-primary focus:border-primary sm:text-sm"
            type="email"
            name="email"
            value="{{ old('email') }}"
            autocomplete="email"
            x-model="form.email"
            x-init="initializeField"
            required>

        <x-blocks.form._error name="email" />
    </label>

    <label>
        <div class="flex mb-1 text-sm font-semibold">@lang('donation.field.phone')</div>
        <input
            class="block w-full border-inherit focus:ring-primary focus:border-primary sm:text-sm"
            type="tel"
            name="phone"
            value="{{ old('phone') }}"
            x-model="form.phone"
            x-init="initializeField"
            autocomplete="tel">

        <x-blocks.form._error name="phone" />
    </label>

    @if ($recurring)
        <fieldset
            class="text-sm border-t sm:col-span-2"
            x-data="{
                isChecked(value) {
                    return this.recurring === value;
                },
            }"
            x-init="initializeField({{ (int) old('recurring', 1) }})" name="recurring">
            <legend class="flex pr-1 mb-2 text-sm font-semibold">@lang('donation.field.recurrence')</legend>

            <div class="grid gap-6 sm:grid-cols-2">
                @foreach (['once', 'monthly'] as $type)
                    <label
                        class="relative flex p-4 border cursor-pointer focus:outline-none"
                        :class="{
                            'bg-primary/5 border-primary/30 z-10': isChecked(@js($loop->index)),
                            'border-gray-200': !isChecked(@js($loop->index)),
                        }">
                        <input
                            type="radio"
                            name="recurring"
                            value="{{ $loop->index }}"
                            x-model.number="form.recurring"
                            class="h-4 w-4 mt-0.5 cursor-pointer shrink-0 text-primary border-gray-300 focus:ring-primary">

                        <span class="block ml-3 text-sm font-medium">
                            @lang("donation.recurrence.$type")
                        </span>
                    </label>
                @endforeach
            </div>

            <x-blocks.form._error name="recurring" />
        </fieldset>
    @else
        <input
            type="hidden"
            name="recurring"
            x-model="recurring"
            x-init="initializeField"
            value="0">
    @endif

    <fieldset
        class="text-sm border-t sm:col-span-2"
        x-data="{
            isChecked(value) {
                    return this.form.amount == value;
                },
                init() {
                    initializeField(@js(old('amount')));
        
                    $watch('form.amount', (value) => {
                        if (value === 'other') {
                            $nextTick(() => $refs[`donation-other-{{ $block->id }}`].focus());
                        }
                    });
                }
        }"
        name="amount">
        <legend class="flex pr-1 mb-2 text-sm font-semibold">@lang('donation.field.amount')</legend>

        <div class="grid gap-4 sm:grid-cols-2 sm:gap-6 md:grid-cols-3 lg:grid-cols-2 xl:grid-cols-3">
            @foreach ($suggestedAmounts as $amount)
                <label
                    class="relative flex p-4 border cursor-pointer focus:outline-none"
                    :class="{
                        'bg-primary/5 border-primary/30 z-10': isChecked(@js($amount)),
                        'border-gray-200': !isChecked(@js($amount)),
                    }">
                    <input
                        type="radio"
                        name="amount"
                        value="{{ $amount }}"
                        x-model.number="form.amount"
                        class="h-4 w-4 mt-0.5 cursor-pointer shrink-0 text-primary border-gray-300 focus:ring-primary mr-3">

                    <span class="block text-sm font-medium">
                        {{ $amount }} {{ $currency }}
                    </span>
                </label>
            @endforeach

            <label
                class="relative flex p-4 border cursor-pointer focus:outline-none"
                :class="{
                    'bg-primary/5 border-primary/30 z-10': isChecked('amount'),
                    'border-gray-200': !isChecked('amount'),
                }">
                <input
                    type="radio"
                    name="amount"
                    value="other"
                    x-model="form.amount"
                    class="h-4 w-4 mt-0.5 cursor-pointer shrink-0 text-primary border-gray-300 focus:ring-primary mr-3">

                <template x-if="form.amount === 'other'">
                    <input
                        class="block w-full p-0 text-sm font-medium bg-transparent border-none appearance-none focus:ring-0 "
                        type="number"
                        name="other"
                        value="{{ old('amount') }}"
                        @@focus="form.amount = 'other'"
                        x-model="form.other"
                        x-ref="donation-other-{{ $block->id }}"
                        x-init="initializeField(@js(old('amount') && $suggestedAmounts->doesntContain(old('amount'))))"
                        required>
                </template>

                <span x-show="form.amount !== 'other'" class="block text-sm font-medium">
                    @lang('donation.amount.other')
                </span>
            </label>
        </div>

        <x-blocks.form._error name="amount" />
        <x-blocks.form._error name="other" />
    </fieldset>

    <div x-show="message || errorList.length > 0" class="p-4 rounded-md bg-red-50 sm:col-span-2" x-cloak>
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

    <div class="pt-7 sm:col-span-2">
        <x-button
            ::disabled="processing"
            type="submit"
            class="items-center justify-center block w-full font-semibold text-white border border-transparent sm:w-auto sm:inline-block bg-primary focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary disabled:opacity-50"
            size="lg">
            @lang('donation.action')
        </x-button>

        <input type="hidden" x-init="initializeField(@js($gateway))" name="gateway" value="{{ $gateway }}">
        <input type="hidden" x-init="initializeField(@js($currency))" name="currency" value="{{ $currency }}">
    </div>
</form>
