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
            :group="`related-${typePlural}`"
            class="w-full border divide-y divide-gray-200 border-inherit list-group"
            ghost-class="opacity-50"
            handle=".handle"
            :animation="200"
            @change="$emit('update:related', related)"
        >
            <template #item="{ element, index }">
                <div class="relative flex text-sm bg-white list-group-item">
                    <div
                        class="flex items-center px-1 py-2 bg-gray-100 border-r cursor-move shrink-0 handle"
                    >
                        <icon name="drag" class="w-2.5 h-6 text-gray-400" />
                    </div>

                    <div class="flex items-center flex-1 px-2 py-4">
                        <div class="flex-1 px-4 shrink">
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

            <template #footer>
                <div
                    class="flex items-center justify-between px-6 py-4 list-group-item"
                >
                    <button
                        type="button"
                        :disabled="!remainingItems"
                        @click="openList"
                        class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 focus:ring-offset-gray-100 disabled:opacity-50"
                    >
                        <icon
                            name="Editor/attachment-2"
                            class="w-5 h-5 mr-2 -ml-1"
                        />

                        <span v-text="$t('app.action.attach')" />
                    </button>

                    <div v-if="limit > 1" class="text-sm text-gray-500">
                        {{ selectedItems.length }} / {{ limit }}
                    </div>
                </div>
            </template>
        </draggable>
    </form-field>

    <base-modal
        container-class="flex flex-col overflow-hidden min-h-64"
        max-width="lg"
        v-if="open"
        @close="open = false"
        is-form
    >
        <div
            v-if="!items.length"
            class="flex flex-col items-center justify-center flex-1 gap-4 px-4 text-sm text-center py-14 sm:px-14"
        >
            <icon
                name="System/error-warning-line"
                class="w-6 h-6 mx-auto text-gray-400"
            />

            <p
                class="text-gray-900"
                v-text="$t(`${typeSingular}.empty.title`)"
            />

            <inertia-link
                :href="route(`admin.${typePlural}.create`)"
                class="font-medium text-blue-600 hover:text-blue-500"
            >
                <span v-text="$t(`${typeSingular}.action.create`)" />
                <span aria-hidden="true"> &rarr;</span>
            </inertia-link>
        </div>

        <template v-else>
            <div class="relative block border-b border-gray-200">
                <icon
                    name="System/search-line"
                    class="pointer-events-none absolute top-3.5 left-4 h-5 w-5 text-gray-400"
                />
                <input
                    type="search"
                    class="w-full h-12 pl-12 pr-4 text-gray-800 placeholder-gray-400 bg-transparent border-0 focus:ring-0 sm:text-sm"
                    autocomplete="off"
                    :placeholder="$t('app.search.placeholder')"
                    @keydown.stop
                    @keydown.enter.prevent
                    v-model="query"
                    ref="search"
                />
            </div>

            <div class="relative flex-1 overflow-scroll">
                <div
                    v-if="query && !filteredItems.length"
                    class="flex flex-col items-center justify-center flex-1 gap-4 px-4 text-sm text-center py-14 sm:px-14"
                >
                    <icon
                        name="System/error-warning-line"
                        class="w-6 h-6 mx-auto text-gray-400"
                    />

                    <p
                        class="text-gray-900"
                        v-text="$t(`${typeSingular}.empty.title`)"
                    />
                </div>

                <ul
                    v-else
                    class="w-full text-sm font-medium divide-y divide-gray-200"
                >
                    <li v-for="(item, index) in filteredItems" :key="index">
                        <form-checkbox
                            class="px-6 py-4 sm:px-8"
                            v-model="selectedItems"
                            :value="item.id"
                            :label="item.title"
                        />
                    </li>
                </ul>
            </div>

            <div
                class="flex items-center justify-between gap-3 px-4 py-3 bg-gray-100 sm:px-6"
            >
                <div class="flex gap-2">
                    <form-button
                        type="button"
                        :disabled="selectedItems.length > limit"
                        @click.prevent="addSelectedItems"
                        color="blue"
                    >
                        <icon
                            name="System/add-line"
                            class="w-5 h-5 mr-2 -ml-1"
                        />

                        <span v-text="$t('app.action.attach')" />
                    </form-button>

                    <form-button
                        type="button"
                        @click.prevent="open = false"
                        color="white"
                    >
                        <span v-text="$t('app.action.close')" />
                    </form-button>
                </div>

                <div class="text-sm text-gray-500">
                    {{ selectedItems.length }} / {{ limit }}
                </div>
            </div>
        </template>
    </base-modal>
</template>

<script>
    import Draggable from 'vuedraggable';
    import { defineInput, useFilter, useRelated, route } from '@/helpers';
    import { computed, ref, watch, nextTick } from 'vue';

    export default defineInput({
        name: 'FormRelated',
        components: {
            Draggable,
        },
        props: {
            typeSingular: {
                type: String,
                required: true,
            },
            typePlural: {
                type: String,
                required: true,
            },
            related: {
                type: Array,
                required: true,
                default: () => [],
            },
            limit: {
                type: Number,
                default: 1,
            },
        },
        emits: ['update:related'],
        setup(props, { emit }) {
            const { filterPredicate } = useFilter();

            const search = ref(null);
            const query = ref('');
            const selectedItems = ref([]);

            const getSelectedItems = () => {
                selectedItems.value = props.related.map((related) => related.id);
            };

            getSelectedItems();

            const open = ref(false);

            const items = ref([]);

            const remainingItems = computed(() =>
                Math.max(0, props.limit - props.related.length)
            );

            const filteredItems = computed(() =>
                !query.value
                    ? items.value
                    : items.value.filter((item) =>
                          filterPredicate(item.title, query.value)
                      )
            );

            const proxySelected = computed({
                get: () => props.related,
                set: (value) => emit('update:related', value),
            });

            const { fetchData } = useRelated();

            const openList = () => {
                fetchData(props.typePlural, {
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

                getSelectedItems();
            };

            watch(open, (value) => {
                if (value) {
                    nextTick(() => search.value.focus());
                }
            });

            return {
                open,
                openList,
                remainingItems,
                selectedItems,
                proxySelected,
                items,
                filteredItems,
                addSelectedItems,
                deleteItem,
                search,
                query,
                route,
            };
        },
    });
</script>

