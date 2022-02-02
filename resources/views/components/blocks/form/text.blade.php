@props(['block'])

<x-blocks.form._field
    :block="$block"
    x-data="{ count: 0 }"
    x-init="count = $refs.input.value.length">

    <input
        {{ $attributes->class(['block w-full border-inherit rounded'])->merge([
            'type' => 'text',
            'name' => $block->name,
            'value' => old($block->name),
            'required' => $block->checkbox('required'),
            'minlength' => $block->input('min_length') ?: null,
            'maxlength' => $block->input('max_length') ?: null,
            'x-on:keyup' => 'count = $refs.input.value.length',
            'x-ref' => 'input',
        ]) }}>

    <div
        x-show="$refs.input.maxLength > 0"
        x-text="$refs.input.maxLength - count"
        class="absolute flex items-center px-1 text-sm text-gray-500 bg-white pointer-events-none inset-y-1 right-1">
    </div>
</x-blocks.form._field>
