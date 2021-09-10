<template>
    <label
        v-if="text"
        :for="target"
        class="block w-full space-x-2 text-sm font-medium text-gray-700"
    >
        <span v-text="text" />

        <span
            role="presentation"
            :title="$t('field.required')"
            class="font-bold text-red-500"
            v-if="required && !disabled"
            v-text="'*'"
        />
    </label>
</template>

<script>
    export default {
        name: 'FormLabel',
        props: {
            text: {
                type: String,
                default: null,
            },
            disabled: {
                type: Boolean,
                default: false,
            },
            required: {
                type: Boolean,
                default: false,
            },
            target: {
                type: String,
                default: null,
            },
        },
    };
</script>
