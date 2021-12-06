@props(['block', 'type' => $block->type])

<x-blocks.form._field :block="$block">
    <input
        @class(['block w-full'])

        @if ($block->checkbox('required')) required @endif

        @if ($block->input('maxlength')) maxlength="{{ $block->input('maxlength') }}" @endif

        type="{{ $type }}"
        name="field[{{ $block->id }}]">
</x-blocks.form._field>
