<template>
    <form-select
        :label="$t('field.type')"
        v-model="content.type"
        :options="types"
        default="question"
    />

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

    <template v-if="content.type === 'question'">
        <form-radio-group
            :label="$t('field.columns')"
            v-model.number="content.columns"
            :options="[1, 2, 3]"
            :default="1"
        />

        <block-repeater
            component="decision-tree-choice"
            :items="children"
            :parameters="otherSteps"
        />
    </template>
</template>

<script>
    import { computed } from 'vue';
    import { trans } from 'laravel-vue-i18n';
    import { defineRepeater } from '@/helpers';

    export default defineRepeater({
        type: 'decision-tree-step',
        fields: {
            id: String,
            type: String,
            title: Object,
            text: Object,
            columns: Number,
        },
        setup(props) {
            const types = computed(() => [
                {
                    label: trans('field.question'),
                    value: 'question',
                },
                {
                    label: trans('field.answer'),
                    value: 'answer',
                },
            ]);

            const otherSteps = computed(() =>
                props.parameters
                    .filter((item) => item.id !== props.content.id)
                    .map((item) => ({
                        label: item.title,
                        value: item.id,
                    }))
            );

            return {
                types,
                otherSteps,
            };
        },
    });
</script>
