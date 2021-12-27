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

    <form-input
        type="text"
        :label="$t('field.button_id')"
        :name="`${prefix}.button_id`"
        v-model="content.button_id"
        required
    />

    <form-checkbox
        :label="$t('field.open_popup')"
        :name="`${prefix}.popup`"
        v-model="content.popup"
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
            popup: Boolean,
        },
    });
</script>
