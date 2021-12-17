@props(['block'])

<label class="block">
    <div @class([
        'flex mb-1',
        'text-red-700' => $errors->has("field-{$block->id}"),
    ])>
        <span class="font-medium">
            {{ $block->translatedInput('label') }}
        </span>

        @if ($block->checkbox('required'))
            <span
                class="ml-1 font-bold text-red-500"
                title="{{ __('field.required') }}"
                role="presentation">*</span>
        @endif

        @if ($block->translatedInput('help'))
            <p class="flex-1 ml-2 text-sm text-right text-gray-500">
                {{ $block->translatedInput('help') }}
            </p>
        @endif
    </div>

    <div @class([
        'relative block w-full shadow-sm',
        'border-red-300 text-red-700 placeholder-red-300' => $errors->has(
            "field-{$block->id}",
        ),
    ])>
        {{ $slot }}
    </div>

    @error("field-{$block->id}")
        <p class="mt-2 text-sm text-red-600">
            {{ $message }}
        </p>
    @enderror
</label>
