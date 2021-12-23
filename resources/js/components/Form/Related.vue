<template>
    <form-field
        :name="name"
        :label="label"
        :label-for="id"
        :help="help"
        :required="required"
        :disabled="disabled"
        :locale="locale"
    >
        <draggable
            :list="related"
            item-key="id"
            :group="`related-${type}`"
            class="w-full border divide-y divide-gray-200 border-inherit list-group"
            ghost-class="opacity-50"
            handle=".handle"
            :animation="200"
            @change="$emit('update:related', related)"
        >
            <template #item="{ element, index }">
                <div class="relative flex text-sm bg-white list-group-item">
                    <div
                        class="w-5 px-1 py-2 bg-gray-100 border-r cursor-move shrink-0 handle"
                    >
                        <icon
                            name="drag"
                            class="w-full h-full text-gray-400"
                            local
                        />
                    </div>

                    <div class="flex flex-1 px-2 py-4">
                        <div class="flex-1 flex-shrink px-4">
                            <div
                                class="font-bold truncate"
                                v-text="element.title"
                            />
                        </div>

                        <div class="shrink-0">
                            <button
                                type="button"
                                @click="deleteItem(index)"
                                class="text-gray-400 hover:text-red-600 focus:outline-none"
                            >
                                <icon
                                    name="System/delete-bin-line"
                                    class="w-5 h-5"
                                />
                            </button>
                        </div>
                    </div>
                </div>
            </template>

            <template #footer v-if="remainingItems">
                <div
                    class="flex items-center justify-between px-6 py-4 list-group-item"
                >
                    <button
                        type="button"
                        class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 focus:ring-offset-gray-100 disabled:opacity-50"
                        :disabled="!remainingItems"
                        @click="openList"
                    >
                        Add Item
                    </button>

                    <div v-if="limit > 1" class="text-sm text-gray-500">
                        Add up to {{ limit }} items
                    </div>
                </div>
            </template>
        </draggable>
    </form-field>

    <action-modal max-width="lg" :show="open" @close="open = false">
        <template #title>Attach related</template>

        <template #content>
            <ul class="w-full text-sm font-medium divide-y divide-gray-200">
                <li v-for="(item, index) in items" :key="index">
                    <form-checkbox
                        class="px-3 py-4"
                        v-model="selectedItems"
                        :value="item.id"
                        :label="item.title"
                    />
                </li>
            </ul>
        </template>

        <template #footer>
            <button
                type="button"
                class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 focus:ring-offset-gray-100 disabled:opacity-50"
                :disabled="!remainingItems"
                @click="addSelectedItems"
            >
                Attach
            </button>

            <div class="text-sm text-gray-500">
                {{ remainingItems }}/{{ limit }}
            </div>
        </template>
    </action-modal>
</template>

<script>
    import Draggable from 'vuedraggable';
    import { defineInput, useRelated } from '@/helpers';
    import { computed, ref } from 'vue';

    export default defineInput({
        name: 'FormRelated',
        components: {
            Draggable,
        },
        props: {
            type: {
                type: String,
                required: true,
            },
            related: {
                type: Array,
                required: true,
            },
            limit: {
                type: Number,
                default: 1,
            },
        },
        emits: ['update:related'],
        setup(props, { emit }) {
            const open = ref(false);

            const items = ref([]);
            const selectedItems = ref(props.related.map((related) => related.id));

            const remainingItems = computed(() =>
                Math.max(0, props.limit - props.related.length)
            );

            const { fetchData } = useRelated();

            const openList = () => {
                fetchData(props.type, {
                    onSuccess: (response) => {
                        items.value = response.data.data;

                        open.value = true;
                    },
                    onError: (error) => {
                        //
                    },
                });
            };

            const addSelectedItems = () => {
                props.related.splice(0, props.related.length);

                selectedItems.value.map((selectedId) => {
                    if (!remainingItems.value) {
                        return;
                    }

                    props.related.push(
                        items.value.find((item) => item.id === selectedId)
                    );
                });

                open.value = false;
            };

            const deleteItem = (index) => {
                props.related.splice(index, 1);
            };

            return {
                open,
                openList,
                remainingItems,
                selectedItems,
                items,
                addSelectedItems,
                deleteItem,
            };
        },
    });
</script>

