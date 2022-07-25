@props(['block'])

<x-blocks.form._field :block="$block" tag="div" no-shadow>
    <fieldset class="mt-3 space-y-3">
        @foreach ($block->options() as $option)
            <div>
                <label class="inline-flex items-center space-x-2">
                    <input
                        {{ $attributes->class('w-4 h-4 text-primary border-gray-300 focus:ring-primary')->merge([
                            'type' => 'radio',
                            'name' => $block->name,
                            'required' => $block->checkbox('required'),
                            'checked' => old($block->name) === $option,
                            'value' => $option,
                            'x-model' => $block->x_model,
                            'x-init' => 'initializeField',
                        ]) }}>

                    <span class="text-sm text-gray-700">
                        {{ $option }}
                    </span>
                </label>
            </div>
        @endforeach
    </fieldset>
</x-blocks.form._field>
