<template>
    <localized-field
        field="form-input"
        :label="$t('field.title')"
        v-model="content.title"
    />

    <form-radio-group
        :label="$t('field.columns')"
        v-model.number="content.columns"
        :options="[1, 2, 3, 4, 5]"
        :default="1"
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
