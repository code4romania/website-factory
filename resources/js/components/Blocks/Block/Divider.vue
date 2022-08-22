<template>
    <form-color-picker :label="$t('field.color')" v-model="content.color" />
</template>

<script>
    import { defineBlock } from '@/helpers';

    export default defineBlock({
        type: 'divider',
        icon: 'Editor/separator',
        fields: {
            color: String,
        },
    });
</script>
