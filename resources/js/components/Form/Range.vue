<template>
    <form-field
        :name="name"
        :label="label"
        :label-for="id"
        :help="help"
        :required="required"
        :disabled="disabled"
        :locale="locale"
    >
        <div class="flex w-full gap-4">
            <input
                class="flex-1 block w-full min-w-0 my-2 border-none focus:outline-none focus:ring-0"
                type="range"
                :name="name"
                :id="id"
                :required="required"
                :disabled="disabled"
                :autofocus="autofocus"
                :placeholder="placeholder"
                v-bind="$attrs"
                :value="modelValue"
                @input="$emit('update:modelValue', $event.target.value)"
            />

            <input
                type="number"
                :value="modelValue"
                @input="$emit('update:modelValue', $event.target.value)"
                class="w-16 text-sm"
            />
        </div>
    </form-field>
</template>

<script>
    import { watch } from 'vue';
    import { defineInput } from '@/helpers';

    export default defineInput({
        name: 'FormRange',
        setup(props, { attrs, emit }) {
            const normalize = (value) => {
                let normalized = value;

                if (attrs.hasOwnProperty('min')) {
                    normalized = Math.max(normalized, attrs.min);
                }

                if (attrs.hasOwnProperty('max')) {
                    normalized = Math.min(normalized, attrs.max);
                }

                if (normalized !== value) {
                    emit('update:modelValue', normalized);
                }
            };

            watch(() => props.modelValue, normalize, {
                immediate: true,
            });
        },
    });
</script>

