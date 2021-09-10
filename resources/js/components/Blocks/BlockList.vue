<template>
    <draggable
        v-model="blocks"
        item-key="id"
        class="grid grid-cols-1 gap-4 md:grid-cols-2"
        handle=".handle"
    >
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
            <button
                type="button"
                class="relative block w-full p-12 text-center border-2 border-gray-300 border-dashed rounded-lg hover:border-gray-400 focus:outline-none focus:ring-2 focus:ring-offset-2"
                @click="addBlock"
            >
                <img
                    src="remixicon/icons/Business/stack-line.svg"
                    class="w-10 h-10 mx-auto text-gray-400 fill-current"
                    svg-inline
                />

                <span class="block mt-2 text-sm font-medium text-gray-900">
                    Add new block
                </span>
            </button>
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
        },
        emits: ['update:blocks'],
        methods: {
            addBlock() {
                this.blocks.push({
                    id: Date.now(),
                    type: 'text',
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
