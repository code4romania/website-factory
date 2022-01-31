<template>
    <form-icon-picker v-model="content.icon" />

    <localized-field
        field="form-input"
        :label="$t('field.title')"
        v-model="content.title"
    />

    <localized-field
        field="form-input"
        :label="$t('field.description')"
        v-model="content.description"
    />

    <form-range
        :label="$t('field.progress')"
        v-model.number="content.progress"
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
    import { defineBlock } from '@/helpers';

    export default defineBlock({
        type: 'progress',
        icon: 'Development/git-commit-line',
        fields: {
            icon: String,
            title: Object,
            description: Object,
            button_text: Object,
            button_url: Object,
            progress: Number,
        },
    });
</script>
