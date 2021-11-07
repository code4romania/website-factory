<template>
    <localized-field
        field="form-input"
        :label="$t('field.title')"
        v-model="content.title"
    />

    <localized-field
        field="form-editor"
        label="Text"
        required
        v-model="content.text"
    />

    <form-media :label="$t('field.image')" v-model:media="media" :limit="1" />
</template>

<script>
    import { defineBlock } from '@/helpers';

    export default defineBlock({
        type: 'hero-side-image',
        icon: 'Design/collage-line',
        fields: {
            title: Object,
            text: Object,
        },
    });
</script>
