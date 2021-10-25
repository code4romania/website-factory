<template>
    <localized-field
        type="form-input"
        :label="$t('field.title')"
        v-model="content.title"
    />

    <localized-field
        type="form-editor"
        label="Text"
        required
        v-model="content.text"
    />

    <form-media :label="$t('field.image')" v-model:media="media" :limit="1" />
</template>

<script>
    import { defineBlock } from '@/helpers';

    export default defineBlock({
        type: 'image-text',
        icon: 'Media/image-2-line',
        fields: {
            title: Object,
            text: Object,
        },
    });
</script>
