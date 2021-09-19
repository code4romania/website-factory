<template>
    <localized-field
        type="form-input"
        :label="$t('field.title')"
        name="blocks[title]"
        required
        v-model="content.title"
    />

    <localized-field
        type="form-textarea"
        label="Text"
        name="blocks[text]"
        required
        v-model="content.text"
    />
</template>

<script>
    export default {
        name: 'ContentBlockCallToAction',
        props: {
            content: {
                type: Object,
                default: () => ({}),
            },
        },
        emits: ['update:content'],

        setup(props) {
            if (!props.content.hasOwnProperty('title')) {
                props.content.title = {};
            }
            if (!props.content.hasOwnProperty('text')) {
                props.content.text = {};
            }
        },
    };
</script>
