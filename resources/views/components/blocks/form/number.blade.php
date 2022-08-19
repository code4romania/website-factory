@props(['block'])

<x-blocks.form._field :block="$block">
    <input
        {{ $attributes->class(['block w-full border-inherit rounded'])->merge([
            'type' => 'number',
            'name' => $block->name,
            'value' => old($block->name),
            'required' => $block->checkbox('required'),
            'min' => $block->input('min_value') ?: null,
            'max' => $block->input('max_value') ?: null,
            'x-model' => $block->x_model,
            'x-init' => 'initializeField',
        ]) }}>
</x-blocks.form._field>
