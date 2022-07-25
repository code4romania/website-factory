@props(['block', 'tag' => 'label', 'noShadow' => false])


<{{ $tag }} {{ $attributes->class('block') }}>
    <div
        class="mb-1"
        :class="{
            'text-red-700': errors[@js($block->name)] !== null,
        }">
        <div class="flex">
            <span class="font-semibold">
                {{ $block->translatedInput('label') }}
            </span>

            @if ($block->checkbox('required'))
                <span
                    class="ml-1 font-bold text-red-500"
                    title="{{ __('field.required') }}"
                    role="presentation">*</span>
            @endif
        </div>

        @if ($block->translatedInput('help'))
            <p class="w-full text-sm leading-tight text-gray-500">
                {{ $block->translatedInput('help') }}
            </p>
        @endif
    </div>

    <div
        @class(['relative block w-full', 'shadow-sm' => !$noShadow])
        :class="{
            'border-red-300 text-red-700 placeholder-red-300': errors[@js($block->name)] !== null,
        }">
        {{ $slot }}
    </div>

    <x-blocks.form._error :name="$block->name" />
    </{{ $tag }}>
