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

    <form-switch :label="$t('field.required')" v-model="content.required" />

    <form-input
        type="number"
        :label="$t('field.min_value')"
        :help="$t('field_help.zero_to_disable')"
        v-model.number="content.min_value"
    />

    <form-input
        type="number"
        :label="$t('field.max_value')"
        :help="$t('field_help.zero_to_disable')"
        v-model.number="content.max_value"
    />
</template>

<script>
    import { defineFormBlock } from '@/helpers';

    export default defineFormBlock({
        type: 'number',
        icon: 'Editor/number-3',
        fields: {
            label: Object,
            help: Object,
            required: Boolean,
            min_value: Number,
            max_value: Number,
        },
    });
</script>
