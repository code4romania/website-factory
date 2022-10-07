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

    <form-media
        :label="$t('field.image')"
        v-model:media="media"
        accepts="images"
        :limit="1"
    />

    <form-switch
        v-if="media.length"
        :label="$t('field.color_overlay')"
        v-model="content.color_overlay_enabled"
    />

    <form-color-picker
        v-if="media.length && content.color_overlay_enabled"
        :label="$t('field.color')"
        v-model="content.color_overlay"
    />

    <form-switch
        v-if="media.length"
        :label="$t('field.image_as_background')"
        v-model="content.image_as_background"
    />
</template>

<script>
    import { defineRepeater } from '@/helpers';

    export default defineRepeater({
        type: 'carousel-item',
        fields: {
            title: Object,
            text: Object,
            color_overlay_enabled: Boolean,
            color_overlay: Boolean,
            image_as_background: Boolean,
            button_text: Object,
            button_url: Object,
        },
    });
</script>
