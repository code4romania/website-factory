<template>
    <localized-field
        field="form-input"
        :label="$t('field.title')"
        v-model="content.title"
    />

    <form-textarea
        :label="$t('field.html')"
        required
        v-model="content.code"
        rows="4"
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
        type: 'html',
        icon: 'Development/code-s-slash-line',
        fields: {
            title: Object,
            code: String,
        },
        setup(props) {
            const aspectRatios = [
                'none',
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
