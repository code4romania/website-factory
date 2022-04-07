<template>
    <localized-field
        field="form-input"
        :label="$t('field.title')"
        v-model="content.title"
    />

    <form-input
        type="number"
        :label="$t('field.columns')"
        v-model.number="content.columns"
        :min="1"
        :max="5"
    />

    <block-repeater
        component="image-with-link"
        :items="children"
        v-model:media="media"
    />
</template>

<script>
    import { defineBlock } from '@/helpers';

    export default defineBlock({
        type: 'images-with-links',
        icon: 'Media/image-add-line',
        fields: {
            title: Object,
            columns: Number,
        },
    });
</script>
