@props(['block'])

<x-blocks.form._field :block="$block">
    <input
        {{ $attributes->class(['block w-full border-inherit rounded'])->merge([
            'type' => 'email',
            'name' => $block->name,
            'value' => old($block->name),
            'required' => $block->checkbox('required'),
        ]) }}>
</x-blocks.form._field>
