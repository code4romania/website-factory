@props(['block'])

<x-blocks.form._field :block="$block">
    <input
        {{ $attributes->class(['block w-full border-inherit rounded'])->merge([
            'type' => 'email',
            'name' => $block->name,
            'value' => old($block->name),
            'required' => $block->checkbox('required'),
            'x-model' => $block->x_model,
            'x-init' => 'initializeField',
        ]) }}>
</x-blocks.form._field>
