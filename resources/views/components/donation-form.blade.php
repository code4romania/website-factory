<div class="bg-gray-800">
    <form
        {{ $attributes->merge([
            'action' => $action,
            'method' => 'post',
            'class' => 'grid sm:grid-cols-2 gap-4 items-start',
        ]) }}>
        @csrf

        <label>
            <div class="flex mb-1 font-semibold text-gray-100">{{ __('donation.field.first_name') }}</div>
            <input
                class="block w-full border-gray-800 rounded-md focus:ring-primary focus:border-primary sm:text-sm"
                type="text"
                name="first_name"
                value="{{ old('first_name') }}"
                required>
        </label>

        <label>
            <div class="flex mb-1 font-semibold text-gray-100">{{ __('donation.field.last_name') }}</div>
            <input
                class="block w-full border-gray-800 rounded-md focus:ring-primary focus:border-primary sm:text-sm"
                type="text"
                name="last_name"
                value="{{ old('last_name') }}"
                required>
        </label>

        <label>
            <div class="flex mb-1 font-semibold text-gray-100">{{ __('donation.field.email') }}</div>
            <input
                class="block w-full border-gray-800 rounded-md focus:ring-primary focus:border-primary sm:text-sm"
                type="email"
                name="email"
                value="{{ old('email') }}"
                required>
        </label>

        <label>
            <div class="flex mb-1 font-semibold text-gray-100">{{ __('donation.field.phone') }}</div>
            <input
                class="block w-full border-gray-800 rounded-md focus:ring-primary focus:border-primary sm:text-sm"
                type="tel"
                name="phone"
                value="{{ old('phone') }}">
        </label>

        <label class="sm:col-span-2">
            <div class="flex mb-1 font-semibold text-gray-100">{{ __('donation.field.amount') }}</div>
            <input
                class="block w-full border-gray-800 rounded-md focus:ring-primary focus:border-primary sm:text-sm"
                type="number"
                name="amount"
                value="{{ old('amount') }}"
                required>
        </label>

        @if ($recurring)
            <div>hehe {{ dump($recurring) }}</div>

        @else
            <input type="hidden" name="recurring" value="false">
        @endif

        <div class="pt-7">
            <x-button
                type="submit"
                class="bg-white border border-transparent text-primary hover:bg-gray-50 focus:ring-offset-primary focus:ring-white"
                size="md">
                @lang('donation.action')
            </x-button>

            <input type="hidden" name="gateway" value="{{ $gateway }}">


            <input type="hidden" name="currency" value="RON">
        </div>
    </form>
</div>
