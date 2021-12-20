@props(['block'])

<x-blocks.form._field :block="$block">
    <input
        {{ $attributes->class(['block w-full border-inherit rounded'])->merge([
            'type' => 'text',
            'name' => $block->name,
            'value' => old($block->name),
            'required' => $block->checkbox('required'),
            'minlength' => $block->input('min_length'),
            'maxlength' => $block->input('max_length'),
        ]) }}>
</x-blocks.form._field>
