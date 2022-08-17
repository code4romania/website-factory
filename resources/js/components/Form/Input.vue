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
        <div
            class="flex w-full border border-inherit focus-within:ring-1 focus-within:ring-blue-500"
        >
            <label
                :for="id"
                v-if="prefix"
                class="inline-flex items-center pl-3 text-gray-400 select-none"
                v-html="prefix"
            />

            <input
                class="flex-1 block w-full min-w-0 border-none focus:outline-none focus:ring-0 disabled:bg-gray-50 disabled:text-gray-600"
                :class="{
                    'pl-0': prefix,
                }"
                :type="type"
                :name="name"
                :id="id"
                :required="required"
                :disabled="disabled"
                :readonly="readonly"
                :autofocus="autofocus"
                :placeholder="placeholder"
                v-bind="$attrs"
                :value="modelValue"
                @input="$emit('update:modelValue', $event.target.value)"
                @blur="ensureHttpOnInputUrl"
            />
        </div>
    </form-field>
</template>

<script>
    import { defineInput } from '@/helpers';

    export default defineInput({
        name: 'FormInput',
        props: {
            type: {
                type: String,
                default: 'text',
            },
            prefix: {
                type: String,
                default: null,
            },
        },
        setup(props, { emit }) {
            const ensureHttpOnInputUrl = (e) => {
                if (props.type !== 'url') {
                    return;
                }

                if (!e.target.value) {
                    return;
                }

                try {
                    new URL(e.target.value);
                } catch (error) {
                    emit('update:modelValue', `http://${e.target.value}`);
                }
            };

            return {
                ensureHttpOnInputUrl,
            };
        },
    });
</script>

