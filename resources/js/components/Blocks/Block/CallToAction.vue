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

    <localized-field
        field="form-input"
        type="text"
        :label="$t('field.button_text')"
        v-model="content.button_text"
    />

    <localized-field
        field="form-input"
        type="url"
        :label="$t('field.button_url')"
        v-model="content.button_url"
    />
</template>

<script>
    import { defineBlock } from '@/helpers';

    export default defineBlock({
        type: 'call-to-action',
        icon: 'Communication/feedback-line',
        fields: {
            title: Object,
            text: Object,
            button_text: Object,
            button_url: Object,
        },
    });
</script>
