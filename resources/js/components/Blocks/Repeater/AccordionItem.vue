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
    import { defineRepeater } from '@/helpers';

    export default defineRepeater({
        type: 'accordion-item',
        fields: {
            title: Object,
            text: Object,
        },
    });
</script>
