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

    <budget-level :items="content.data" />
</template>

<script>
    import { defineBlock } from '@/helpers';

    export default defineBlock({
        type: 'budget',
        icon: 'Business/bar-chart-box-line',
        fields: {
            title: Object,
            text: Object,
            data: Array,
        },
    });
</script>
