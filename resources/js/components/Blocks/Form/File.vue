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

    <form-checkbox-group
        :label="$t('field.file_types')"
        v-model="content.accepts"
        :options="accepts"
    />

    <form-switch
        :label="$t('field.allow_multiple_files')"
        v-model="content.multiple"
    />

    <form-input
        v-if="content.multiple"
        type="number"
        :label="$t('field.max_files')"
        :help="$t('field_help.zero_to_disable')"
        v-model.number="content.max_files"
    />
</template>

<script>
    import { computed } from 'vue';
    import { trans } from 'laravel-vue-i18n';
    import { defineFormBlock } from '@/helpers';

    export default defineFormBlock({
        type: 'file',
        icon: 'Business/attachment-line',
        fields: {
            label: Object,
            help: Object,
            required: Boolean,
            multiple: Boolean,
            max_files: Number,
            accepts: Array,
        },
        setup(props) {
            const accepts = computed(() =>
                [
                    'image',
                    'vector',
                    'pdf',
                    'video',
                    'audio',
                    'archive',
                    'document',
                    'spreadsheet',
                    'presentation',
                    'other',
                ].map((type) => ({
                    value: type,
                    label: trans(`media.accepts.${type}`),
                }))
            );

            return {
                accepts,
            };
        },
    });
</script>
