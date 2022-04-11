<template>
    <draggable
        :list="items"
        item-key="id"
        class="grid gap-4"
        handle=".handle"
        ghost-class="opacity-50"
        :animation="200"
        @change="$emit('update:modelValue', items)"
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
            <div>
                <button
                    type="button"
                    @click="addBlock"
                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 focus:ring-offset-gray-100"
                >
                    <icon name="System/add-line" class="w-5 h-5 mr-2 -ml-1" />

                    <span v-text="$t('app.action.add')" />
                </button>
            </div>
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
            items: {
                type: Array,
                default: () => [],
            },
        },
        emits: ['update:modelValue'],
        setup(props) {
            const addBlock = () => {
                props.items.push({
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
                    ...cloneDeep(props.items[index]),
                    id: Date.now(),
                };

                props.items.splice(index + 1, 0, block);
            };

            const deleteBlock = (index) => {
                props.items.splice(index, 1);
            };

            return {
                addBlock,
                duplicateBlock,
                deleteBlock,
            };
        },
    };
</script>
