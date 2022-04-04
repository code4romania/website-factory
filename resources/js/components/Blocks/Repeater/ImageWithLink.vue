<template>
    <form-media :label="$t('field.image')" v-model:media="media" :limit="1" />

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
        },
    });
</script>
