<template>
    <form-media
        :label="$t('field.image')"
        v-model:media="media"
        accepts="images"
        :limit="1"
    />

    <localized-field
        field="form-editor"
        :label="$t('field.caption')"
        v-model="content.caption"
    />

    <localized-field
        field="form-input"
        type="url"
        :label="$t('field.url')"
        v-model="content.url"
    />
</template>

<script>
    import { defineRepeater } from '@/helpers';

    export default defineRepeater({
        type: 'image-with-link',
        fields: {
            url: Object,
            caption: Object,
        },
    });
</script>
