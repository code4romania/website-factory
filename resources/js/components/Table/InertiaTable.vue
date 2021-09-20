<template>
    <div class="flex items-center justify-between space-x-2">
        <table-filters :collection="collection" />

        <inertia-link
            class="relative inline-flex items-center justify-center px-4 py-2 text-sm font-semibold tracking-wider text-white transition duration-150 ease-in-out bg-green-600 border border-transparent hover:bg-green-700 focus:ring-green-500 focus:outline-none focus:ring-2 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-default"
            :href="route(this.collection.route_prefix + '.create')"
            v-text="createActionLabel || $t('app.action.create')"
        />
    </div>

    <div class="my-4 overflow-x-auto">
        <table class="min-w-full text-gray-900 table-fixed">
            <table-header
                :columns="collection.columns"
                :sort="collection.sort"
                :base-url="baseUrl"
                v-model:selectedAll="selectedAll"
            />

            <tbody class="divide-y divide-gray-200">
                <tr
                    class="text-gray-900 hover:bg-gray-50 focus-within:bg-blue-50"
                    v-for="(row, rowIndex) in collection.data"
                    :key="rowIndex"
                >
                    <template
                        v-for="(column, columnIndex) in collection.columns"
                    >
                        <td
                            v-if="column.field === 'bulk'"
                            class="w-0 p-5 pr-2.5"
                            :key="`bulk-${columnIndex}`"
                        >
                            <form-checkbox
                                v-model="selected"
                                :value="row.id"
                                @update="
                                    (checked) => toggleSelect(checked, row)
                                "
                            />
                        </td>

                        <td v-else class="text-sm" :key="columnIndex">
                            <inertia-link
                                class="block px-6 py-4 focus:outline-none"
                                :href="rowUrl(row)"
                                :tabindex="columnIndex === 0 ? false : -1"
                            >
                                <slot
                                    :name="column.field"
                                    :[column.field]="row[column.field]"
                                    :row="row"
                                >
                                    {{ row[column.field] }}
                                </slot>
                            </inertia-link>
                        </td>
                    </template>
                </tr>
            </tbody>
        </table>
    </div>

    <pagination v-if="paginate" :meta="collection.meta" />

    <table-empty
        v-if="!collection.data.length"
        :id="collection.model"
        :action="emptyAction"
    />
</template>

<script>
    import { usePage } from '@inertiajs/inertia-vue3';

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
            routeName: {
                type: String,
                default: null,
            },
            routeArgs: {
                type: Object,
                default: () => ({}),
            },
            sortable: {
                type: Boolean,
                default: true,
            },
            emptyTitle: {
                type: String,
                default: null,
            },
            emptyDescription: {
                type: String,
                default: null,
            },
            emptyActionLabel: {
                type: String,
                default: null,
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
        data() {
            return {
                selected: [],
            };
        },
        computed: {
            baseUrl() {
                if (!this.routeName || !this.sortable) {
                    return null;
                }

                return this.route(usePage().props.value.route, this.sortArgs);
            },
            visibleIds() {
                return this.collection.data.map((item) => item.id);
            },
            selectedAll: {
                set(value) {
                    if (value === true) {
                        this.selected = this.visibleIds;
                    } else {
                        this.selected = [];
                    }
                },

                get() {
                    const visible = new Int8Array(this.visibleIds).sort();
                    const selected = new Int8Array(this.selected).sort();

                    return (
                        selected.length === visible.length &&
                        selected.every((value, index) => value === visible[index])
                    );
                },
            },

            // selectedAll() {
            //     const visible = new Int8Array(
            //         this.collection.data.map((item) => item.id)
            //     ).sort();

            //     const selected = new Int8Array(this.selected).sort();

            //     return (
            //         selected.length === visible.length &&
            //         selected.every((value, index) => value === visible[index])
            //     );
            // },
        },
        methods: {
            rowUrl(row) {
                return this.route(this.collection.route_prefix + '.edit', row);
            },
            toggleSelect(checked, row) {
                if (checked) {
                    this.selected.push(row.id);
                } else {
                    this.selected = this.selected.filter((id) => id !== row.id);
                }
            },
        },
    };
</script>
