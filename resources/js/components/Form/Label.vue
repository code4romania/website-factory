<template>
    <label class="flex text-sm font-medium text-gray-700">
        <span v-if="value" v-text="value" />

        <slot v-else />

        <span class="ml-1 font-bold text-red-500" v-if="required && !disabled">
            *
        </span>
    </label>
</template>

<script>
    export default {
        name: 'FormLabel',
        // props: ['value'],
        props: {
            required: {
                type: Boolean,
                default: false,
            },
            disabled: {
                type: Boolean,
                default: false,
            },
            value: {
                type: String,
                default: null,
            },
        },
    };
</script>
