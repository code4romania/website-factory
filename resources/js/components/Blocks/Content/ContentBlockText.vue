<template>
    <localized-field
        type="form-input"
        label="Name"
        name="blocks[name]"
        required
        v-model="content.name"
    />

    <localized-field
        type="form-textarea"
        label="Other name"
        name="blocks[other]"
        required
        v-model="content.other"
    />
</template>

<script>
    import { reactive } from 'vue';

    export default {
        name: 'ContentBlockText',
        props: {
            content: {
                type: Object,
                default: () => ({}),
            },
        },
        emits: ['update:content'],
    };
</script>
