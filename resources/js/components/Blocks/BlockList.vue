<template>
    <draggable
        :list="blocks"
        item-key="id"
        group="blocks"
        class="grid items-start grid-cols-1 gap-4 md:grid-cols-2"
        ghost-class="opacity-50"
        handle=".handle"
        :animation="200"
        @change="$emit('update:blocks', blocks)"
    >
        <template #header>
            <div
                class="relative flex items-center mt-8 md:col-span-2"
                aria-hidden="true"
            >
                <span
                    class="pr-3 text-lg font-medium text-gray-900"
                    v-text="title || $t('field.content')"
                />

                <div class="flex-1 border-t border-gray-300" />
            </div>
        </template>

        <template #item="{ element, index }">
            <block-item
                :id="element.id"
                :type="blockType"
                :component="element.type"
                :class="{ 'md:col-span-2': element.content.fullwidth }"
                v-model:content="element.content"
                v-model:children="element.children"
                v-model:media="element.media"
                v-model:related="element.related"
                @duplicate="duplicateBlock(index)"
                @delete="deleteBlock(index)"
                can-duplicate
                can-expand
            />
        </template>

        <template #footer>
            <dropdown
                class="md:col-span-2"
                origin="bottom-left"
                trigger-class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 focus:ring-offset-gray-100"
            >
                <template #trigger>
                    <icon
                        name="Business/stack-line"
                        class="w-5 h-5 mr-2 -ml-1"
                    />

                    <span v-text="action || $t('block.add-new')" />
                </template>

                <template #content>
                    <dropdown-item
                        v-for="(item, index) in allowedBlocks"
                        :key="index"
                        type="button"
                        @click="addBlock(item.type)"
                        class="flex items-center"
                    >
                        <icon
                            :name="item.icon"
                            class="w-5 h-5 mr-3 text-gray-500 group-hover:text-gray-600"
                        />

                        <span class="flex-1" v-text="item.label" />
                    </dropdown-item>
                </template>
            </dropdown>
        </template>
    </draggable>
</template>

<script>
    import { computed } from 'vue';
    import { usePage } from '@inertiajs/inertia-vue3';
    import cloneDeep from 'lodash/cloneDeep';
    import Draggable from 'vuedraggable';

    export default {
        name: 'BlockList',
        components: {
            Draggable,
        },
        props: {
            blocks: {
                type: Array,
                required: true,
            },
            blockType: {
                type: String,
                default: 'block',
            },
            title: {
                type: String,
                default: null,
            },
            action: {
                type: String,
                default: null,
            },
        },
        emits: ['update:blocks'],
        setup(props) {
            const allowedBlocks = computed(
                () => usePage().props.value.model.allowed_blocks
            );

            const addBlock = (type) => {
                props.blocks.push({
                    id: Date.now(),
                    type: type,
                    content: {
                        fullwidth: true,
                    },
                    children: [],
                    media: [],
                    related: [],
                });
            };

            const duplicateBlock = (index) => {
                const block = {
                    ...cloneDeep(props.blocks[index]),
                    id: Date.now(),
                };

                props.blocks.splice(index + 1, 0, block);
            };

            const deleteBlock = (index) => {
                props.blocks.splice(index, 1);
            };

            return {
                allowedBlocks,
                addBlock,
                duplicateBlock,
                deleteBlock,
            };
        },
    };
</script>
