<template>
    <localized-field
        field="form-input"
        :label="$t('field.title')"
        v-model="content.title"
    />

    <form-select
        :label="$t('field.align')"
        v-model="content.align"
        :options="align"
    />

    <localized-field
        field="form-editor"
        :label="$t('field.text')"
        v-model="content.text"
    />
</template>

<script>
    import { computed } from 'vue';
    import { trans } from 'laravel-vue-i18n';
    import { defineBlock } from '@/helpers';

    export default defineBlock({
        type: 'header',
        icon: 'Design/collage-line',
        fields: {
            title: Object,
            text: Object,
            align: String,
        },
        setup(props) {
            const align = computed(() =>
                ['left', 'center'].map((align) => ({
                    value: align,
                    label: trans(`align.${align}`),
                }))
            );

            if (!props.content.align) {
                props.content.align = align[0];
            }

            return {
                align,
            };
        },
    });
</script>
