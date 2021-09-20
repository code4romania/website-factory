<template>
    <label :for="target" class="block w-full text-sm font-medium">
        <span v-text="text" />

        <span
            role="presentation"
            :title="$t('field.required')"
            class="ml-1 font-bold text-red-500"
            v-if="required"
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
                required: true,
            },
            target: {
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
        },
    };
</script>
