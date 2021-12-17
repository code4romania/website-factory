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

    <form-datepicker :label="$t('field.min_date')" v-model="content.min_date" />

    <form-datepicker :label="$t('field.max_date')" v-model="content.max_date" />
</template>

<script>
    import { defineFormBlock } from '@/helpers';

    export default defineFormBlock({
        type: 'date',
        icon: 'Business/calendar-event-line',
        fields: {
            label: Object,
            help: Object,
            required: Boolean,
            min_date: String,
            max_date: String,
        },
    });
</script>
