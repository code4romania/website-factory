@props([
    'currency' => 'RON',
    'block',
])

<form
    {{ $attributes->merge([
        'action' => $action,
        'method' => 'post',
        'class' => 'grid sm:grid-cols-2 gap-6 items-start px-4 py-10 bg-gray-50 sm:px-6 md:px-8',
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
            2required>

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
            autocomplete="tel">

        <x-blocks.form._error name="phone" />
    </label>

    @if ($recurring)
        <fieldset
            class="text-sm border-t sm:col-span-2"
            x-data="{
                recurring: @js((int) old('recurring', 1)),
                isChecked(value) {
                    return this.recurring === value;
                },
            }">
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
                            x-model.number="recurring"
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
        <input type="hidden" name="recurring" value="0">
    @endif

    <fieldset
        class="text-sm border-t sm:col-span-2"
        x-data="{
            amount: @js(old('amount')),
            other: @js(old('amount') && $suggestedAmounts->doesntContain(old('amount'))),
            isChecked(value) {
                return this.amount == value;
            },
        }"
        x-init="$watch('amount', (value) => {
            if (value === 'other') {
                $nextTick(() => $refs[`donation-other-{{ $block->id }}`].focus());
            }
        })">
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
                        x-model.number="amount"
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
                    x-model="amount"
                    class="h-4 w-4 mt-0.5 cursor-pointer shrink-0 text-primary border-gray-300 focus:ring-primary mr-3">

                <template x-if="amount === 'other'">
                    <input
                        class="block w-full p-0 text-sm font-medium bg-transparent border-none appearance-none focus:ring-0 "
                        type="number"
                        name="other"
                        value="{{ old('amount') }}"
                        @@focus="amount = 'other'"
                        @@keyup="console.log(other)"
                        x-model="other"
                        x-ref="donation-other-{{ $block->id }}"
                        required>
                </template>

                <span x-show="amount !== 'other'" class="block text-sm font-medium">
                    @lang('donation.amount.other')
                </span>
            </label>
        </div>

        <x-blocks.form._error name="amount" />
        <x-blocks.form._error name="other" />
    </fieldset>

    <div class="pt-7">
        <x-button
            type="submit"
            class="items-center justify-center block w-full font-semibold text-white border border-transparent sm:w-auto sm:inline-block bg-primary focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary"
            size="lg">
            @lang('donation.action')
        </x-button>

        <input type="hidden" name="gateway" value="{{ $gateway }}">
        <input type="hidden" name="currency" value="{{ $currency }}">
    </div>
</form>
