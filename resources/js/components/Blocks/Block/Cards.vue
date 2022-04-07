<template>
    <localized-field
        field="form-input"
        :label="$t('field.title')"
        v-model="content.title"
    />

    <form-input
        type="number"
        :label="$t('field.columns')"
        v-model.number="content.columns"
        :min="1"
        :max="5"
    />

    <form-checkbox :label="$t('field.shadow')" v-model="content.shadow" />

    <block-repeater component="card-item" :items="children" />
</template>

<script>
    import { defineBlock } from '@/helpers';

    export default defineBlock({
        type: 'cards',
        icon: 'Editor/list-check-2',
        fields: {
            title: Object,
            columns: Number,
            shadow: Boolean,
        },
    });
</script>
