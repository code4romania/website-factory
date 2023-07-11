<template>
    <localized-field
        field="form-input"
        :label="$t('field.title')"
        v-model="content.title"
        required
    />

    <localized-field
        field="form-input"
        :label="$t('field.description')"
        v-model="content.description"
    />

    <form-select
        :label="$t('field.go_to_step')"
        v-model="content.step"
        :options="parameters"
        required
    />
</template>

<script>
    import { defineRepeater } from '@/helpers';

    export default defineRepeater({
        type: 'decision-tree-choice',
        fields: {
            title: Object,
            description: Object,
            step: String,
        },
    });
</script>
