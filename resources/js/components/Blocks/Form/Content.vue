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
    import { defineFormBlock } from '@/helpers';

    export default defineFormBlock({
        type: 'content',
        fields: {
            title: Object,
            text: Object,
        },
    });
</script>
