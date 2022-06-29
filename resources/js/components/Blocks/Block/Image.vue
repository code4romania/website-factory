<template>
    <localized-field
        field="form-input"
        :label="$t('field.title')"
        v-model="content.title"
    />

    <form-media
        :label="$t('field.image')"
        v-model:media="media"
        accepts="images"
        :limit="1"
    />
</template>

<script>
    import { defineBlock } from '@/helpers';

    export default defineBlock({
        type: 'image',
        icon: 'Media/image-2-line',
        fields: {
            title: Object,
        },
    });
</script>
