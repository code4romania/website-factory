<template>
    <localized-field
        field="form-input"
        :label="$t('field.title')"
        v-model="content.title"
    />

    <form-radio-group
        :label="$t('field.columns')"
        v-model.number="content.columns"
        :options="[1, 2, 3, 4, 5]"
        :default="1"
    />

    <block-repeater component="counter-item" :items="children" />
</template>

<script>
    import { defineBlock } from '@/helpers';

    export default defineBlock({
        type: 'counter',
        icon: 'Business/flag-line',
        fields: {
            title: Object,
        },
    });
</script>
