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

    <form-input
        type="number"
        :label="$t('field.min_length')"
        help="0 = disabled"
        v-model.number="content.min_length"
        :min="0"
    />

    <form-input
        type="number"
        :label="$t('field.max_length')"
        help="0 = disabled"
        v-model.number="content.max_length"
        :min="0"
    />
</template>

<script>
    import { defineFormBlock } from '@/helpers';

    export default defineFormBlock({
        type: 'textarea',
        icon: 'Editor/paragraph',
        fields: {
            label: Object,
            help: Object,
            required: Boolean,
            min_length: Number,
            max_length: Number,
        },
    });
</script>
