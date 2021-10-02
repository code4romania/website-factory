<template>
    <localized-field
        type="form-input"
        :label="$t('field.title')"
        name="blocks[title]"
        required
        v-model="content.title"
    />

    <localized-field
        type="form-textarea"
        label="Text"
        name="blocks[text]"
        required
        v-model="content.text"
    />
</template>

<script>
    import { defineBlock } from '@/helpers';

    export default defineBlock({
        type: 'call-to-action',
        fields: ['title', 'text'],
    });
</script>
