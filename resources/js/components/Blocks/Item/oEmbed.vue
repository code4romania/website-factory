<template>
    <localized-field
        type="form-input"
        :label="$t('field.title')"
        required
        v-model="content.title"
    />

    <form-input
        type="url"
        :label="$t('field.url')"
        required
        v-model="content.url"
    />
</template>

<script>
    import { defineBlock } from '@/helpers';

    export default defineBlock({
        type: 'o-embed',
        icon: 'Development/code-s-slash-line',
        fields: {
            title: Object,
            url: String,
        },
    });
</script>
