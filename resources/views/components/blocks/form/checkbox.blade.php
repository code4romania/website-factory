@props(['block'])
<script>
    console.log(@json($block));
</script>
<x-blocks.form._field :block="$block" tag="div" no-shadow>
    <fieldset class="mt-3 space-y-3" x-init="initializeField([])" name="{{ $block->name }}">
        @foreach ($block->options() as $option)
            <div>
                <label class="inline-flex items-center gap-x-2">
                    <input
                        {{ $attributes->class('w-4 h-4 text-primary border-gray-300 focus:ring-primary')->merge([
                            'type' => 'checkbox',
                            'name' => "{$block->name}[]",
                            // 'required' => $block->checkbox('required'),
                            'checked' => in_array($option, Arr::wrap(old("$block->name"))),
                            'value' => $option,
                            'x-model' => $block->x_model,
                        ]) }}>

                    <span class="text-sm text-gray-700">
                        {{ $option }}
                    </span>
                </label>
            </div>
        @endforeach

        @if ($block->checkbox('enable_other'))
            <div>
                <label class="text-sm text-gray-700">Introduceți altceva:</label>
                <input type="text" name="{$block->name}[]" value="testingvalue" class="w-full border-gray-300 focus:ring-primary">
            </div>
        @endif
    </fieldset>
</x-blocks.form._field>
