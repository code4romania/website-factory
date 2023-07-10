<template>
    <localized-field
        field="form-editor"
        :label="$t('field.text')"
        v-model="content.text"
    />

    <form-select
        :label="$t('field.go_to_step')"
        v-model="content.step"
        :options="parameters"
    />
</template>

<script>
    import { defineRepeater } from '@/helpers';

    export default defineRepeater({
        type: 'decision-tree-choice',
        fields: {
            text: Object,
            step: String,
        },
    });
</script>
