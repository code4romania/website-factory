<template>
    <localized-field
        type="form-editor"
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
            text: Object,
        },
    });
</script>
