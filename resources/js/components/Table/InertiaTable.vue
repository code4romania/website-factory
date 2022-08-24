<template>
    <table-bulk-actions
        v-if="selected.length"
        :items="collection.data"
        :selected="selected"
        @clear="clearSelected"
    />

    <div v-else class="flex items-center justify-between gap-x-2">
        <table-filters v-if="!disableFilters" :collection="collection" />

        <inertia-link
            v-if="!disableCreate"
            class="relative inline-flex items-center justify-center px-4 py-2 text-sm font-semibold tracking-wider text-white transition duration-150 ease-in-out bg-green-600 border border-transparent hover:bg-green-700 focus:ring-green-500 focus:outline-none focus:ring-2 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-default"
            :href="route(collection.properties.admin_route_prefix + '.create')"
            v-text="createActionLabel || $t('app.action.create')"
        />
    </div>

    <div class="my-4 overflow-x-scroll md:overflow-visible">
        <table class="w-full text-gray-900 border-collapse table-fixed">
            <table-header
                :columns="collection.columns"
                :sort="collection.sort"
                v-model:selectAll="selectAll"
            />

            <tbody class="divide-y divide-gray-200">
                <table-row
                    v-for="(row, rowIndex) in collection.data"
                    :key="rowIndex"
                    :collection="collection"
                    :row="row"
                    :selected="selected.includes(row.id)"
                    @toggle="toggleRow"
                    class="text-gray-900"
                    :class="{
                        'hover:bg-gray-50 focus-within:bg-gray-50 group': canInteractWithRows,
                    }"
                >
                    <template
                        v-for="(_, name) in $slots"
                        v-slot:[name]="slotData"
                    >
                        <slot :name="name" v-bind="slotData" />
                    </template>
                </table-row>
            </tbody>
        </table>
    </div>

    <pagination v-if="paginate" :meta="collection.meta" />

    <table-empty
        v-if="!collection.data.length"
        :properties="collection.properties"
    />
</template>

<script>
    import { ref, computed } from 'vue';

    export default {
        name: 'InertiaTable',
        props: {
            collection: {
                type: Object,
                required: true,
            },
            paginate: {
                type: Boolean,
                default: true,
            },
            disableCreate: {
                type: Boolean,
                default: false,
            },
            disableFilters: {
                type: Boolean,
                default: false,
            },
            emptyAction: {
                type: String,
                default: null,
            },
            createActionLabel: {
                type: String,
                default: null,
            },
        },
        setup(props) {
            const selected = ref([]);

            const canInteractWithRows = computed(() => {
                if (
                    props.collection.filters.hasOwnProperty('status') &&
                    props.collection.filters.status === 'trashed'
                ) {
                    return false;
                }

                return true;
            });

            const visibleIds = computed(() =>
                props.collection.data.map((item) => item.id)
            );

            const toggleSelect = (checked, row) => {
                if (checked) {
                    selected.value.push(row.id);
                } else {
                    selected.value = selected.value.filter((id) => id !== row.id);
                }
            };

            const toggleRow = ({ id, checked }) => {
                if (checked) {
                    selected.value.push(id);
                } else {
                    selected.value = selected.value.filter((rowId) => rowId !== id);
                }
            };

            const selectAll = computed({
                get: () => {
                    const sortedVisible = new Int8Array(visibleIds.value).sort();
                    const sortedSelected = new Int8Array(selected.value).sort();

                    return (
                        sortedSelected.length === sortedVisible.length &&
                        sortedSelected.every(
                            (value, index) => value === sortedVisible[index]
                        )
                    );
                },

                set: (value) => {
                    if (value === true) {
                        selected.value = visibleIds.value;
                    } else {
                        selected.value = [];
                    }
                },
            });

            const clearSelected = () => {
                selected.value = [];
            };

            return {
                selected,
                canInteractWithRows,
                visibleIds,
                toggleSelect,
                toggleRow,
                selectAll,
                clearSelected,
            };
        },
    };
</script>
