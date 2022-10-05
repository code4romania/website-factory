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

    <form-switch
        :label="$t('field.show_images')"
        v-model="content.show_images"
    />

    <form-related
        :label="$t('field.people')"
        v-model:related="related"
        type-singular="person"
        type-plural="people"
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
