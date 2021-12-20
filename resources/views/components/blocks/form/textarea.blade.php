@props(['block'])

<x-blocks.form._field :block="$block">
    <textarea
        {{ $attributes->class(['block w-full border-inherit rounded'])->merge([
            'rows' => 4,
            'name' => $block->name,
            'required' => $block->checkbox('required'),
            'minlength' => $block->input('min_length'),
            'maxlength' => $block->input('max_length'),
        ]) }}>{{ old($block->name) }}</textarea>
</x-blocks.form._field>
