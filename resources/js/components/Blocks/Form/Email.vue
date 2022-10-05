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
</template>

<script>
    import { defineFormBlock } from '@/helpers';

    export default defineFormBlock({
        type: 'email',
        icon: 'Business/at-line',
        fields: {
            label: Object,
            help: Object,
            required: Boolean,
        },
    });
</script>
