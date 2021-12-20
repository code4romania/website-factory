@props(['block'])

<x-blocks.form._field :block="$block">
    <select
        {{ $attributes->class(['block w-full border-inherit rounded'])->merge([
            'name' => $block->name,
            'required' => $block->checkbox('required'),
        ]) }}>

        <option {{ !old($block->name) ? 'selected' : '' }} value="" disabled>
            &mdash;
        </option>

        @foreach ($block->options() as $option)
            <option {{ old($block->name) === $option ? 'selected' : '' }}>
                {{ $option }}
            </option>
        @endforeach
    </select>
</x-blocks.form._field>
