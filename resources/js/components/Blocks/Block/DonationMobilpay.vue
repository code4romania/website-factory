<template>
    <localized-field
        field="form-input"
        :label="$t('field.title')"
        v-model="content.title"
    />

    <localized-field
        field="form-editor"
        label="Text"
        v-model="content.text"
        required
    />
</template>

<script>
    import { defineBlock } from '@/helpers';

    export default defineBlock({
        type: 'donation-mobilpay',
        icon: 'Finance/secure-payment-line',
        fields: {
            title: Object,
            text: Object,
        },
    });
</script>
