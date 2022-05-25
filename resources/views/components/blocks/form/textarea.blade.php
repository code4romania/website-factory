@props(['block'])

<x-blocks.form._field
    :block="$block"
    x-data="{ length: 0 }"
    x-init="length = $refs.textarea.value.length">

    <textarea
        {{ $attributes->class(['block w-full border-inherit rounded'])->merge([
            'rows' => 4,
            'name' => $block->name,
            'required' => $block->checkbox('required'),
            'minlength' => $block->input('min_length') ?: null,
            'maxlength' => $block->input('max_length') ?: null,
            'x-on:keyup' => 'length = $refs.textarea.value.length',
            'x-ref' => 'textarea',
        ]) }}>{{ old($block->name) }}</textarea>

    <div
        x-show="$refs.textarea.maxLength > 0"
        x-text="$refs.textarea.maxLength - length"
        class="absolute flex items-center px-1 text-sm leading-9 text-gray-500 bg-white pointer-events-none top-1 right-1">
    </div>
</x-blocks.form._field>
