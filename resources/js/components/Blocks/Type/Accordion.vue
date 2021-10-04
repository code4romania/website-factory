<template>
    <localized-field
        type="form-input"
        :label="$t('field.title')"
        name="blocks[title]"
        required
        v-model="content.title"
    />

    <block-repeater type="accordion-item" v-model="blocks" />
</template>

<script>
    import { defineBlock } from '@/helpers';

    export default defineBlock({
        type: 'accordion',
        icon: 'Editor/list-check-2',
        fields: ['text', 'blocks'],
    });
</script>
