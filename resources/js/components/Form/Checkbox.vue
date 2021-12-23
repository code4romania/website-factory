<template>
    <div v-bind="$attrs">
        <div class="flex space-x-2">
            <input
                type="checkbox"
                :id="id"
                :name="name"
                class="text-blue-600 border-gray-300 rounded shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 my-0.5"
                v-model="proxyChecked"
                :value="value"
                :required="required"
                :disabled="disabled"
                :autofocus="autofocus"
            />

            <form-label
                v-if="label"
                :target="id"
                :text="label"
                :required="required && !disabled"
                class="text-gray-700"
            />
        </div>

        <p
            v-if="help"
            class="mt-1 ml-6 text-sm"
            :class="{
                'text-gray-300': $attrs.disabled,
                'text-gray-500': !$attrs.disabled,
            }"
            v-text="help"
        />
    </div>
</template>

<script>
    import { computed } from 'vue';
    import { defineInput } from '@/helpers';

    export default defineInput({
        name: 'FormCheckbox',
        props: {
            value: {
                default: null,
            },
        },
        setup(props, { emit }) {
            const proxyChecked = computed({
                get: () => props.modelValue,
                set: (value) => emit('update:modelValue', value),
            });

            return {
                proxyChecked,
            };
        },
    });
</script>
