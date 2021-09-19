<template>
    <draggable
        v-model="blocks"
        item-key="id"
        class="grid grid-cols-1 gap-4 md:grid-cols-2"
        handle=".handle"
        @change="$emit('update:blocks', blocks)"
    >
        <template #header>
            <div
                class="relative flex items-center mt-8 md:col-span-2"
                aria-hidden="true"
            >
                <span
                    class="pr-3 text-lg font-medium text-gray-900"
                    v-text="label || $t('field.content')"
                />

                <div class="flex-1 border-t border-gray-300" />
            </div>
        </template>

        <template #item="{ element, index }">
            <block-item
                :id="element.id"
                :type="element.type"
                :class="{ 'md:col-span-2': element.content.fullwidth }"
                v-model:content="element.content"
                @delete="deleteBlockAt(index)"
            />
        </template>

        <template #footer>
            <dropdown
                class="md:col-span-2"
                origin="bottom-left"
                trigger-class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 focus:ring-offset-gray-100"
            >
                <template #trigger>
                    <img
                        src="remixicon/icons/Business/stack-line.svg"
                        class="w-5 h-5 mr-2 -ml-1 fill-current"
                        svg-inline
                    />

                    <span class=""> Add new block </span>
                </template>

                <template #content>
                    <dropdown-item
                        v-for="(blockType, index) in availableBlockTypes"
                        :key="index"
                        type="button"
                        @click="addBlock(blockType.type)"
                        class="flex items-center"
                    >
                        <img
                            src="remixicon/icons/Editor/paragraph.svg"
                            class="w-5 h-5 mr-2 text-gray-400 fill-current"
                            svg-inline
                        />

                        <span
                            class="flex-1"
                            v-text="$t(`block.${blockType.type}`)"
                        />
                    </dropdown-item>
                </template>
            </dropdown>
        </template>
    </draggable>
</template>

<script>
    import draggable from 'vuedraggable';

    export default {
        name: 'BlockList',
        components: {
            draggable,
        },
        props: {
            blocks: {
                type: Array,
                required: true,
            },
            label: {
                type: String,
                default: null,
            },
        },
        emits: ['update:blocks'],
        computed: {
            availableBlockTypes() {
                return [
                    //
                    { icon: 'Editor/paragraph-line', type: 'text' },
                    { icon: 'Editor/paragraph-line', type: 'call-to-action' },
                ];
            },
        },
        methods: {
            addBlock(type) {
                this.blocks.push({
                    id: Date.now(),
                    type: type,
                    content: {
                        fullwidth: false,
                    },
                });
            },
            deleteBlockAt(index) {
                this.blocks.splice(index, 1);
            },
        },
    };
</script>
