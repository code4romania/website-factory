<template>
    <form-icon-picker v-model="content.icon" />

    <localized-field
        field="form-input"
        :label="$t('field.title')"
        v-model="content.title"
    />

    <localized-field
        field="form-editor"
        label="Text"
        required
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
</template>

<script>
    import { defineRepeater } from '@/helpers';

    export default defineRepeater({
        type: 'card-item',
        fields: {
            icon: String,
            title: Object,
            text: Object,
            button_text: Object,
            button_url: Object,
        },
    });
</script>
