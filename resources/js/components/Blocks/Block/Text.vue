<template>
    <localized-field
        field="form-input"
        :label="$t('field.title')"
        required
        v-model="content.title"
    />

    <localized-field
        field="form-editor"
        label="Text"
        required
        v-model="content.text"
    />
</template>

<script>
    import { defineBlock } from '@/helpers';

    export default defineBlock({
        type: 'text',
        fields: {
            title: Object,
            text: Object,
        },
    });
</script>
