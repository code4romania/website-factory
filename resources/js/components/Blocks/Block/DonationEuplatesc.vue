<template>
    <localized-field
        field="form-input"
        :label="$t('field.title')"
        v-model="content.title"
    />

    <localized-field
        field="form-editor"
        :label="$t('field.text')"
        v-model="content.text"
    />
</template>

<script>
    import { defineBlock } from '@/helpers';

    export default defineBlock({
        type: 'donation-euplatesc',
        icon: 'Finance/secure-payment-line',
        fields: {
            title: Object,
            text: Object,
        },
        feature: 'donations',
    });
</script>
