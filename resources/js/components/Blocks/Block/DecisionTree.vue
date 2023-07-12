<template>
    <block-repeater
        component="decision-tree-step"
        :items="children"
        :parameters="steps"
        :add-button-label="$t('app.action.addStep')"
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
            text: Object,
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
