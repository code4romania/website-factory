<template>
    <localized-field
        field="form-input"
        :label="$t('field.title')"
        v-model="content.title"
    />

    <form-input
        type="url"
        :label="$t('field.url')"
        required
        v-model="content.url"
    />

    <form-select
        :label="$t('field.aspect_ratio')"
        v-model="content.aspect_ratio"
        :options="aspectRatios"
    />
</template>

<script>
    import { defineBlock } from '@/helpers';

    export default defineBlock({
        type: 'iframe',
        icon: 'Development/code-s-slash-line',
        fields: {
            title: Object,
            url: String,
        },
        setup(props) {
            const aspectRatios = [
                '1/1',
                '5/4',
                '4/3',
                '3/2',
                '5/3',
                '16/9',
                '2/1',
                '3/1',
                '5/6',
                '4/5',
                '3/4',
                '2/3',
                '3/5',
                '9/16',
                '1/2',
                '1/3',
            ];

            return {
                aspectRatios,
            };
        },
    });
</script>
