<template>
    <localized-field
        field="form-input"
        :label="$t('field.label')"
        v-model="content.label"
        required
    />

    <localized-field
        field="form-input"
        :label="$t('field.help')"
        v-model="content.help"
    />

    <form-checkbox :label="$t('field.required')" v-model="content.required" />

    <localized-field
        field="form-textarea"
        :label="$t('field.options')"
        :help="$t('field_help.one_per_line')"
        v-model="content.options"
    />
</template>

<script>
    import { defineFormBlock } from '@/helpers';

    export default defineFormBlock({
        type: 'select',
        icon: 'Editor/list-unordered',
        fields: {
            label: Object,
            help: Object,
            required: Boolean,
            options: Object,
        },
    });
</script>
