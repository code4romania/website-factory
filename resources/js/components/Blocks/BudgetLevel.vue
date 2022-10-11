<template>
    <draggable
        :list="items"
        item-key="id"
        handle=".handle"
        group="budget"
        ghost-class="opacity-50"
        :animation="200"
        @change="$emit('update:modelValue', items)"
    >
        <template #item="{ element, index }">
            <div
                class="py-2"
                :class="{
                    'border-l pl-7': depth > 0,
                }"
            >
                <div class="flex flex-wrap items-end gap-4 sm:flex-nowrap">
                    <div class="w-3 py-2 cursor-move handle shrink-0">
                        <icon
                            name="drag"
                            class="w-full h-full text-gray-400"
                            local
                        />
                    </div>

                    <div class="flex-1 basis-2/3">
                        <localized-field
                            field="form-input"
                            :label="$t('field.label')"
                            v-model="element.name"
                        />
                    </div>

                    <div class="flex-1 basis-1/3">
                        <form-input
                            type="number"
                            :label="$t('field.value')"
                            v-model.number="element.value"
                        />
                    </div>

                    <div class="flex gap-1 shrink-0">
                        <button
                            type="button"
                            @click="deleteItem(index)"
                            class="p-3 text-red-500 border border-transparent focus:outline-none bg-red-50"
                        >
                            <icon
                                name="System/delete-bin-line"
                                class="w-4 h-4 fill-current"
                            />
                        </button>

                        <button
                            type="button"
                            @click="addItem"
                            class="p-3 text-white bg-blue-600 border border-transparent shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 focus:ring-offset-gray-100"
                        >
                            <icon
                                name="System/add-line"
                                class="w-4 h-4 fill-current"
                            />
                        </button>

                        <button
                            v-if="depth <= 5"
                            type="button"
                            @click="addChild(element)"
                            class="p-3 text-white bg-blue-600 border border-transparent shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 focus:ring-offset-gray-100"
                        >
                            <icon
                                name="Editor/indent-increase"
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
                    @click="addItem"
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
            const addItem = () => {
                props.items.push({
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
            };

            const deleteItem = (index) => {
                props.items.splice(index, 1);
            };

            return {
                addItem,
                addChild,
                deleteItem,
            };
        },
    };
</script>
