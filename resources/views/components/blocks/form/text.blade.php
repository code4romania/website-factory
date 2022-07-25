@props(['block'])

<x-blocks.form._field
    :block="$block"
    x-data="{ length: 0 }"
    x-init="length = $refs.input.value.length">

    <input
        {{ $attributes->class(['block w-full border-inherit rounded'])->merge([
            'type' => 'text',
            'name' => $block->name,
            'value' => old($block->name),
            'required' => $block->checkbox('required'),
            'minlength' => $block->input('min_length') ?: null,
            'maxlength' => $block->input('max_length') ?: null,
            'x-on:keyup' => 'length = $refs.input.value.length',
            'x-ref' => 'input',
            'x-model' => $block->x_model,
            'x-init' => 'initializeField',
        ]) }}>

    <div
        x-show="$refs.input.maxLength > 0"
        x-text="$refs.input.maxLength - length"
        class="absolute flex items-center px-1 text-sm leading-9 text-gray-500 bg-white pointer-events-none top-1 right-1">
    </div>
</x-blocks.form._field>
