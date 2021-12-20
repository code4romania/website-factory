@props(['block', 'tag' => 'label', 'noShadow' => false, 'inlineHelp' => true])


<{{ $tag }} class="block">
    <div @class([
        'flex mb-1',
        'text-red-700' => $errors->has($block->name),
        'flex-wrap' => !$inlineHelp,
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
            <p
                @class([
                    'text-sm text-gray-500 leading-tight',
                    'flex-1 ml-2 text-right' => $inlineHelp,
                    'w-full' => !$inlineHelp,
                ])>
                {{ $block->translatedInput('help') }}
            </p>
        @endif
    </div>

    <div @class([
        'relative block w-full',
        'shadow-sm' => !$noShadow,
        'border-red-300 text-red-700 placeholder-red-300' => $errors->has(
            $block->name,
        ),
    ])>
        {{ $slot }}
    </div>

    @error($block->name)
        <p class="mt-2 text-sm text-red-600">
            {{ $message }}
        </p>
    @enderror
    </{{ $tag }}>
