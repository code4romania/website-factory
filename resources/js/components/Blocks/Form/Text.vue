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
        :label="$t('field.maxlength')"
        v-model.number="content.maxlength"
        :min="1"
    />
</template>

<script>
    import { defineFormBlock } from '@/helpers';

    export default defineFormBlock({
        type: 'text',
        icon: 'Editor/text',
        fields: {
            label: Object,
            help: Object,
            required: Boolean,
            maxlength: Number,
        },
    });
</script>
