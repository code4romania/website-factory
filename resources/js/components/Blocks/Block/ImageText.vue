<template>
    <localized-field
        field="form-input"
        :label="$t('field.title')"
        v-model="content.title"
    />

    <localized-field
        field="form-editor"
        :label="$t('field.text')"
        v-model="content.text"
    />

    <form-media
        :label="$t('field.image')"
        v-model:media="media"
        accepts="images"
        :limit="1"
    />

    <form-radio-group
        :label="$t('field.image_position')"
        v-model="content.position"
        :options="position"
        default="left"
    />

    <form-radio-group
        :label="$t('field.image_width')"
        v-model="content.width"
        :options="['25%', '33%', '50%']"
        default="25%"
    />

    <form-radio-group
        :label="$t('field.align')"
        v-model="content.align"
        :options="align"
        default="top"
    />

    <localized-field
        field="form-input"
        type="text"
        :label="$t('field.button_text')"
        v-model="content.primary_button_text"
    />

    <localized-field
        field="form-input"
        type="url"
        :label="$t('field.button_url')"
        v-model="content.primary_button_url"
    />

    <localized-field
        field="form-input"
        type="text"
        :label="$t('field.button_text')"
        v-model="content.secondary_button_text"
    />

    <localized-field
        field="form-input"
        type="url"
        :label="$t('field.button_url')"
        v-model="content.secondary_button_url"
    />
</template>

<script>
    import { computed } from 'vue';
    import { trans } from 'laravel-vue-i18n';
    import { defineBlock } from '@/helpers';

    export default defineBlock({
        type: 'image-text',
        icon: 'Media/image-2-line',
        fields: {
            title: Object,
            text: Object,
            position: String,
            align: String,
            width: String,
            primary_button_text: Object,
            primary_button_url: Object,
            secondary_button_text: Object,
            secondary_button_url: Object,
        },
        setup(props) {
            const position = computed(() =>
                ['left', 'right'].map((position) => ({
                    value: position,
                    label: trans(`align.${position}`),
                }))
            );

            const align = computed(() =>
                ['top', 'center', 'bottom'].map((align) => ({
                    value: align,
                    label: trans(`align.${align}`),
                }))
            );

            return {
                position,
                align,
            };
        },
    });
</script>
