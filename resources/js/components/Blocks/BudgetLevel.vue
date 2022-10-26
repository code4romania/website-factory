<template>
    <draggable
        :list="items"
        item-key="id"
        handle=".handle"
        :group="{ name: 'budget', pull }"
        ghost-class="opacity-50"
        :animation="200"
        @change="$emit('update:modelValue', items)"
    >
        <template #item="{ element, index }">
            <div
                class="py-2 bg-white"
                :class="{
                    'border-l pl-7': depth > 0,
                }"
            >
                <div class="flex flex-wrap items-end gap-4 sm:flex-nowrap">
                    <div
                        class="flex items-center px-1 py-2 cursor-move handle shrink-0"
                    >
                        <icon name="drag" class="w-2.5 h-6 text-gray-400" />
                    </div>

                    <div class="flex-1 basis-2/3">
                        <localized-field
                            field="form-input"
                            :label="$t('field.label')"
                            v-model="element.name"
                        />
                    </div>

                    <div
                        class="flex-1 basis-1/3"
                        v-if="!element.children.length"
                    >
                        <form-input
                            type="number"
                            :label="$t('field.value')"
                            v-model.number="element.value"
                            required
                        />
                    </div>

                    <div class="flex gap-1 shrink-0">
                        <button
                            v-if="depth < maxDepth"
                            type="button"
                            @click="addChild(element)"
                            class="p-3 text-gray-700 bg-white border border-gray-300 shadow-sm hover:bg-gray-50 focus:outline-blue-600 active:bg-blue-600 active:text-white"
                            :title="$t('app.action.addItemChild')"
                        >
                            <icon
                                name="Map/guide-fill"
                                class="w-4 h-4 rotate-90 fill-current"
                            />
                        </button>

                        <button
                            type="button"
                            @click="addItem(index + 1)"
                            class="p-3 text-gray-700 bg-white border border-gray-300 shadow-sm hover:bg-gray-50 focus:outline-blue-600 active:bg-blue-600 active:text-white"
                            :title="$t('app.action.addItemSameLevel')"
                        >
                            <icon
                                name="System/add-line"
                                class="w-4 h-4 fill-current"
                            />
                        </button>

                        <button
                            type="button"
                            @click="deleteItem(index)"
                            class="p-3 text-red-700 bg-white border border-gray-300 shadow-sm hover:bg-gray-50 focus:outline-red-600 active:bg-red-600 active:text-white"
                            :title="$t('app.action.delete')"
                        >
                            <icon
                                name="System/delete-bin-line"
                                class="w-4 h-4 fill-current"
                            />
                        </button>
                    </div>
                </div>

                <budget-level
                    :depth="depth + 1"
                    :items="element.children"
                    class="pl-7"
                />
            </div>
        </template>

        <template #footer v-if="depth === 0">
            <div class="mt-8">
                <button
                    type="button"
                    @click="addItem()"
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
    import Draggable from 'vuedraggable';

    export default {
        name: 'BudgetLevel',
        components: {
            Draggable,
        },
        props: {
            depth: {
                type: Number,
                default: 0,
            },
            items: {
                type: Array,
                default: () => [],
            },
        },
        emits: ['update:modelValue', 'parentadd'],
        setup(props) {
            const maxDepth = 5;

            const addItem = (index) => {
                console.log(`addItem after ${index}`);

                if (typeof index === 'undefined') {
                    index = props.items.length;
                }

                props.items.splice(index, 0, {
                    id: Date.now(),
                    name: {},
                    value: null,
                    children: [],
                });
            };

            const addChild = (item) => {
                item.children.push({
                    id: Date.now(),
                    name: {},
                    value: null,
                    children: [],
                });

                item.value = null;
            };

            const deleteItem = (index) => {
                props.items.splice(index, 1);
            };

            const pull = (to, from, el) => {
                if (to.el.dataset.depth >= maxDepth) {
                    return false;
                }

                return true;
            };

            return {
                maxDepth,
                addItem,
                addChild,
                deleteItem,
                pull,
            };
        },
    };
</script>
