<template>
    <localized-field
        field="form-input"
        :label="$t('field.title')"
        v-model="content.title"
    />

    <block-repeater
        component="decision-tree-step"
        :items="children"
        :parameters="steps"
    />
</template>

<script>
    import uniqid from 'uniqid';
    import { computed } from 'vue';
    import { defineBlock } from '@/helpers';

    export default defineBlock({
        type: 'decision-tree',
        icon: 'Editor/node-tree',
        fields: {
            title: Object,
        },
        setup(props) {
            const steps = computed(() =>
                props.children.map(({ content }) => {
                    if (!content.hasOwnProperty('id')) {
                        content.id = uniqid();
                    }

                    return content;
                })
            );

            return {
                steps,
            };
        },
    });
</script>
