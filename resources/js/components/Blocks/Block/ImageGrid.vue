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

    <form-media
        :label="$t('field.images')"
        v-model:media="media"
        accepts="images"
        :limit="20"
    />
</template>

<script>
    import { defineBlock } from '@/helpers';

    export default defineBlock({
        type: 'image-grid',
        icon: 'Media/image-add-line',
        fields: {
            title: Object,
            columns: Number,
        },
    });
</script>
