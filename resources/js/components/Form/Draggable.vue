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
            item-key="id"
            :list="modelValue"
            class="grid w-full grid-cols-1 gap-4 border-inherit"
            @change="$emit('update:modelValue', modelValue)"
        >
            <template #item="{ element, index }">
                <div class="flex w-full space-x-2 border-inherit">
                    <input
                        class="flex-1 block w-full min-w-0 border focus:outline-none border-inherit focus:ring-1 focus:ring-blue-500"
                        :type="type"
                        :name="name"
                        :id="index"
                        :required="required"
                        :disabled="disabled"
                        :autofocus="autofocus"
                        :placeholder="placeholder"
                        v-bind="$attrs"
                        v-model="element.amount"
                    />

                    <button
                        type="button"
                        @click="remove(index)"
                        class="p-3 text-gray-500 shrink-0 hover:text-red-600 focus:outline-none"
                    >
                        <icon name="System/delete-bin-line" class="w-5 h-5" />
                    </button>
                </div>
            </template>

            <template #footer>
                <div>
                    <button
                        type="button"
                        @click="add"
                        class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 focus:ring-offset-gray-100"
                    >
                        <icon
                            name="System/add-line"
                            class="w-5 h-5 mr-2 -ml-1"
                        />

                        <span v-text="$t('app.action.add')" />
                    </button>
                </div>
            </template>
        </draggable>
    </form-field>
</template>

<script>
    import { defineInput } from '@/helpers';
    import Draggable from 'vuedraggable';

    export default defineInput({
        name: 'FormDraggable',
        components: {
            Draggable,
        },
        props: {
            type: {
                type: String,
                default: 'text',
            },
            modelValue: {
                type: Array,
                default: () => [],
            },
        },
        setup(props) {
            const add = () => {
                props.modelValue.push({
                    id: Date.now(),
                    amount: 0,
                });
            };
            const remove = (index) => {
                props.modelValue.splice(index, 1);
            };

            return {
                add,
                remove,
            };
        },
    });
</script>

