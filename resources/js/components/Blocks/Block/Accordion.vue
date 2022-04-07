<template>
    <localized-field
        field="form-input"
        :label="$t('field.title')"
        v-model="content.title"
    />

    <block-repeater component="accordion-item" :items="children" />
</template>

<script>
    import { defineBlock } from '@/helpers';

    export default defineBlock({
        type: 'accordion',
        icon: 'Editor/list-check-2',
        fields: {
            title: Object,
        },
    });
</script>
