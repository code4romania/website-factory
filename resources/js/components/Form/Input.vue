<template>
    <input
        class="border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
        ref="input"
    />
</template>

<script>
    export default {
        name: 'FormInput',

        props: {
            modelValue: {
                type: [String, Number],
                default: null,
            },
        },

        emits: ['update:modelValue'],
    };
</script>

