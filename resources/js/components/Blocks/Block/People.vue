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

    <form-select
        :label="$t('field.people')"
        v-model="content.people"
        :options="people"
        option-value-key="id"
        option-label-key="name"
        multiple
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
            people: Array,
        },
    });
</script>
