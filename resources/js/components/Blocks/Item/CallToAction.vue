<template>
    <localized-field
        type="form-input"
        :label="$t('field.title')"
        required
        v-model="content.title"
    />

    <localized-field
        type="form-textarea"
        :label="$t('field.text')"
        required
        v-model="content.text"
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
        },
    });
</script>
