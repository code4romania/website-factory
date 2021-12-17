@props(['block'])

<x-blocks.form._field :block="$block">
    <input
        {{ $attributes->class(['block w-full border-inherit rounded'])->merge([
            'type' => $block->type,
            'name' => "field-{$block->id}",
            'value' => old("field-{$block->id}"),
            'required' => $block->checkbox('required'),
            'min' => $block->input('min_value') || null,
            'max' => $block->input('max_value') || null,
        ]) }}>
</x-blocks.form._field>
