<template>
    <draggable
        v-model="modelValue"
        item-key="id"
        class="grid gap-4"
        handle=".handle"
        ghost-class="opacity-50"
        :animation="200"
        @change="$emit('update:blocks', blocks)"
    >
        <template #item="{ element, index }">
            <block-item
                :id="element.id"
                type="repeater"
                :component="component"
                v-model:content="element.content"
                v-model:children="element.children"
                v-model:media="element.media"
                v-model:related="element.related"
                @duplicate="duplicateBlock(index)"
                @delete="deleteBlock(index)"
                can-duplicate
            />
        </template>

        <template #footer>
            <button type="button" @click="addBlock">Add another</button>
        </template>
    </draggable>
</template>

<script>
    import cloneDeep from 'lodash/cloneDeep';
    import Draggable from 'vuedraggable';

    export default {
        name: 'BlockRepeater',
        components: {
            Draggable,
        },
        props: {
            component: {
                type: String,
                required: true,
            },
            modelValue: {
                type: Array,
                default: () => [],
            },
        },
        emits: ['update:modelValue'],
        setup(props) {
            const addBlock = () => {
                props.modelValue.push({
                    id: Date.now(),
                    type: props.component,
                    content: {},
                    children: [],
                    media: [],
                    related: [],
                });
            };

            const duplicateBlock = (index) => {
                const block = {
                    ...cloneDeep(props.modelValue[index]),
                    id: Date.now(),
                };

                props.modelValue.splice(index + 1, 0, block);
            };

            const deleteBlock = (index) => {
                props.modelValue.splice(index, 1);
            };

            return {
                addBlock,
                duplicateBlock,
                deleteBlock,
            };
        },
    };
</script>
