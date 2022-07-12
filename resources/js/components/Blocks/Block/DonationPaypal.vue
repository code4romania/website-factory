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

    <form-input
        type="text"
        :label="$t('field.button_id')"
        v-model="content.button_id"
        required
    />
</template>

<script>
    import { defineBlock } from '@/helpers';

    export default defineBlock({
        type: 'donation-paypal',
        icon: 'Logos/paypal-line',
        fields: {
            title: Object,
            text: Object,
            button_id: String,
        },
        feature: 'donations',
    });
</script>
