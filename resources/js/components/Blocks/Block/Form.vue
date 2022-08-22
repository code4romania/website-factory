<template>
    <localized-field
        field="form-input"
        :label="$t('field.title')"
        v-model="content.title"
    />

    <form-related
        :label="$t('field.form')"
        v-model:related="related"
        type-singular="form"
        type-plural="forms"
        :limit="1"
    />
</template>

<script>
    import { defineBlock } from '@/helpers';

    export default defineBlock({
        type: 'form',
        icon: 'Document/draft-line',
        fields: {
            title: Object,
        },
    });
</script>
