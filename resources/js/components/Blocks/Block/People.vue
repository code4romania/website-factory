<template>
    <localized-field
        field="form-input"
        :label="$t('field.title')"
        required
        v-model="content.title"
    />

    <localized-field
        field="form-editor"
        label="Text"
        required
        v-model="content.text"
    />

    <form-checkbox
        :label="$t('field.show_images')"
        v-model="content.show_images"
    />

    <form-related
        :label="$t('field.people')"
        v-model:related="related"
        type="people"
        :limit="100"
    />
</template>

<script>
    import { defineBlock } from '@/helpers';

    export default defineBlock({
        type: 'people',
        icon: 'User/group-line',
        fields: {
            title: Object,
            text: Object,
            show_images: Boolean,
        },
    });
</script>
