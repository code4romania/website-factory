<template>
    <localized-field
        field="form-editor"
        :label="$t('field.text')"
        v-model="content.text"
    />
</template>

<script>
    import { defineBlock } from '@/helpers';

    export default defineBlock({
        type: 'notice',
        icon: 'System/alert-line',
        fields: {
            text: Object,
            color: String,
        },
    });
</script>
