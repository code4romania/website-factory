<template>
    <form-color-picker :label="$t('field.color')" v-model="content.color" />
</template>

<script>
    import { defineFormBlock } from '@/helpers';

    export default defineFormBlock({
        type: 'divider',
        icon: 'Editor/separator',
        fields: {
            color: String,
        },
    });
</script>
