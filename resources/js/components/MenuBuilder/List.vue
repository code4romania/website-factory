<template>
    <draggable
        :list="items"
        item-key="id"
        :group="{ name: 'menu-items', pull }"
        ghost-class="opacity-50"
        handle=".handle"
        animation="200"
        tag="ol"
        :fallback-on-body="true"
        :swap-treshold="0.65"
        :data-depth="depth"
        class="-space-y-px"
    >
        <template #item="{ element, index }">
            <menu-builder-item
                :item="element"
                :index="index"
                :depth="depth"
                :max-depth="maxDepth"
                @delete="deleteItem(index)"
                :prefix="prefix"
            />
        </template>

        <template #header v-if="!depth">
            <div><!-- collapse controls --></div>
        </template>

        <template #footer v-if="!depth">
            <div class="pt-8">
                <button
                    type="button"
                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 focus:ring-offset-gray-100"
                    @click="addItem"
                >
                    <icon
                        name="Business/stack-line"
                        class="w-5 h-5 mr-2 -ml-1"
                    />

                    <span v-text="$t('app.action.add')" />
                </button>
            </div>
        </template>
    </draggable>
</template>

<script>
    import Draggable from 'vuedraggable';

    export default {
        name: 'MenuBuilderList',
        components: {
            Draggable,
        },
        props: {
            items: {
                type: Array,
                required: true,
            },
            depth: {
                type: Number,
                default: 0,
            },
            maxDepth: {
                type: Number,
                default: 2,
            },
            prefix: {
                type: String,
                required: true,
            },
        },
        setup(props) {
            const addItem = () => {
                props.items.push({
                    label: {},
                    type: 'external',
                    new_tab: false,
                    url: {},
                    children: [],
                });
            };

            const deleteItem = (index) => {
                props.items.splice(index, 1);
            };

            const pull = (to, from, el) => {
                const toDepth = to.el.dataset.depth;

                if (toDepth > props.maxDepth) {
                    return false;
                }

                if (el.querySelector('ol')?.children.length) {
                    return false;
                }

                return true;
            };

            return {
                addItem,
                deleteItem,
                pull,
            };
        },
    };
</script>
