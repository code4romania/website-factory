<template>
    <localized-field
        type="form-input"
        :label="$t('field.title')"
        name="blocks[title]"
        required
        v-model="content.title"
    />

    <localized-field
        type="form-editor"
        label="Text"
        name="blocks[text]"
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
