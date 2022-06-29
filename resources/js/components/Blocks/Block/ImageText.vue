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

    <form-select
        :label="$t('field.position')"
        v-model="content.position"
        :options="['left', 'right']"
    />

    <form-select
        :label="$t('field.image_width')"
        v-model="content.width"
        :options="['25%', '33%', '50%']"
    />

    <form-select
        :label="$t('field.align')"
        v-model="content.align"
        :options="['top', 'center', 'bottom']"
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
        type: 'image-text',
        icon: 'Media/image-2-line',
        fields: {
            title: Object,
            text: Object,
            position: String,
            align: String,
            width: String,
        },
    });
</script>
