<template>
    <localized-field
        field="form-input"
        :label="$t('field.title')"
        v-model="content.title"
    />

    <localized-field
        field="form-editor"
        :label="$t('field.text')"
        v-model="content.text"
    />

    <localized-field
        field="form-input"
        type="text"
        :label="$t('field.button_text')"
        v-model="content.button_text"
    />

    <localized-field
        field="form-input"
        type="url"
        :label="$t('field.button_url')"
        v-model="content.button_url"
    />

    <form-media :label="$t('field.image')" v-model:media="media" :limit="1" />
</template>

<script>
    import { defineBlock } from '@/helpers';

    export default defineBlock({
        type: 'hero-bg-image',
        icon: 'Design/collage-line',
        fields: {
            title: Object,
            text: Object,
            button_text: Object,
            button_url: Object,
        },
    });
</script>
