@props(['block'])

<x-blocks.form._field :block="$block">
    <input
        {{ $attributes->class(['block w-full border-inherit rounded'])->merge([
            'type' => $block->type,
            'name' => "field-{$block->id}",
            'value' => old("field-{$block->id}"),
            'required' => $block->checkbox('required'),
            'minlength' => $block->input('min_length'),
            'maxlength' => $block->input('max_length'),
        ]) }}>
</x-blocks.form._field>
