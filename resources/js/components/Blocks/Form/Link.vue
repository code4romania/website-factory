<template>
    <localized-field
        field="form-input"
        :label="$t('field.label')"
        v-model="content.label"
    />

    <localized-field
        field="form-input"
        :label="$t('field.help')"
        v-model="content.help"
    />

    <form-checkbox :label="$t('field.required')" v-model="content.required" />
</template>

<script>
    import { defineFormBlock } from '@/helpers';

    export default defineFormBlock({
        type: 'link',
        icon: 'Editor/link',
        fields: {
            label: Object,
            help: Object,
            required: Boolean,
        },
    });
</script>
