<template>
    <draggable
        v-model="list"
        item-key="id"
        class="grid grid-cols-1 gap-4 md:grid-cols-2"
        handle=".handle"
    >
        <template #item="{ element, index }">
            <block-item
                :type="element.type"
                :id="element.id"
                :class="{ 'md:col-span-2': element.fullwidth }"
                v-model:fullwidth="element.fullwidth"
                @delete="deleteBlockAt(index)"
            />
        </template>

        <template #footer>
            <button
                type="button"
                class="relative block w-full p-12 text-center border-2 border-gray-300 border-dashed rounded-lg  hover:border-gray-400 focus:outline-none focus:ring-2 focus:ring-offset-2"
                @click="addBlock"
            >
                <icon
                    name="Business/stack-line"
                    class="w-10 h-10 mx-auto text-gray-400"
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
    import uniqid from 'uniqid';
    import { ref, onMounted } from 'vue';

    export default {
        name: 'BlockList',
        components: {
            draggable,
        },
        setup() {
            const list = ref([]);

            const addBlock = () => {
                list.value.push({
                    id: uniqid(),
                    type: 'text',
                    fullwidth: false,
                });
            };

            const deleteBlockAt = (index) => {
                list.value.splice(index, 1);
            };

            onMounted(() => {
                addBlock();
                addBlock();
                addBlock();
            });

            return {
                list,
                addBlock,
                deleteBlockAt,
            };
        },
    };
</script>
