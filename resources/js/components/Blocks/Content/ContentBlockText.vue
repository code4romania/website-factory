<template>
    <localized-field
        type="form-editor"
        label="Text"
        name="blocks[text]"
        required
        v-model="content.text"
    />
</template>

<script>
    export default {
        name: 'ContentBlockText',
        props: {
            content: {
                type: Object,
                default: () => ({}),
            },
        },
        emits: ['update:content'],

        setup(props) {
            if (!props.content.hasOwnProperty('text')) {
                props.content.text = {};
            }
        },
    };
</script>
