<template>
    <localized-field
        field="form-input"
        :label="$t('field.title')"
        v-model="content.title"
    />

    <form-range
        :label="$t('field.columns')"
        v-model.number="content.columns"
        :min="1"
        :max="5"
    />

    <block-repeater component="counter-item" :items="children" />
</template>

<script>
    import { defineBlock } from '@/helpers';

    export default defineBlock({
        type: 'counter',
        icon: 'Editor/rounded-corner',
        fields: {
            title: Object,
        },
    });
</script>
