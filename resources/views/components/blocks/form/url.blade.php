<x-blocks.form._field :block="$block">
    <input
        {{ $attributes->class(['block w-full border-inherit rounded'])->merge([
            'type' => 'url',
            'name' => "field-{$block->id}",
            'value' => old("field-{$block->id}"),
            'required' => $block->checkbox('required'),
        ]) }}>
</x-blocks.form._field>
