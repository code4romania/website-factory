<template>
    <form-icon-picker v-model="content.icon" />

    <form-input
        type="text"
        :label="$t('field.value')"
        v-model="content.value"
    />

    <localized-field
        field="form-input"
        type="text"
        :label="$t('field.label')"
        v-model="content.label"
    />

    <form-switch
        :label="$t('field.show_label_under_value')"
        v-model="content.show_label_under_value"
    />
</template>

<script>
    import { defineRepeater } from '@/helpers';

    export default defineRepeater({
        type: 'counter-item',
        fields: {
            icon: String,
            value: String,
            label: Object,
        },
    });
</script>
