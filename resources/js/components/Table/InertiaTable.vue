<template>
    <div class="flex items-center justify-between space-x-2">
        <table-filters :collection="collection" />

        <inertia-link
            class="relative inline-flex items-center justify-center px-4 py-2 text-sm font-semibold tracking-wider text-white transition duration-150 ease-in-out bg-green-600 border border-transparent hover:bg-green-700 focus:ring-green-500 focus:outline-none focus:ring-2 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-default"
            :href="route(this.collection.properties.route_prefix + '.create')"
            v-text="createActionLabel || $t('app.action.create')"
        />
    </div>

    <div class="my-4 overflow-x-scroll md:overflow-visible">
        <table class="min-w-full text-gray-900 table-fixed">
            <table-header
                :columns="collection.columns"
                :sort="collection.sort"
                :base-url="baseUrl"
                v-model:selectedAll="selectedAll"
            />

            <tbody class="divide-y divide-gray-200">
                <tr
                    class="text-gray-900"
                    :class="{
                        'hover:bg-gray-50 focus-within:bg-gray-50 group': rowsAreClickable,
                    }"
                    v-for="(row, rowIndex) in collection.data"
                    :key="rowIndex"
                >
                    <template
                        v-for="(column, columnIndex) in collection.columns"
                    >
                        <td
                            v-if="column.field === 'bulk'"
                            :key="`bulk-${columnIndex}`"
                            class="w-0 p-5 pr-2.5"
                        >
                            <form-checkbox
                                v-model="selected"
                                :value="row.id"
                                @update="
                                    (checked) => toggleSelect(checked, row)
                                "
                            />
                        </td>

                        <table-actions
                            v-else-if="column.field === 'actions'"
                            :key="`actions-${columnIndex}`"
                            :properties="collection.properties"
                            :row="row"
                        />

                        <td
                            v-else-if="columnIndex === 1"
                            :key="`title-${columnIndex}`"
                            class="px-6 py-4 text-sm font-medium"
                        >
                            <span
                                class="text-gray-900"
                                v-html="rowStatus(row)"
                            />

                            <inertia-link
                                v-if="
                                    !row.hasOwnProperty('trashed') ||
                                    !row.trashed
                                "
                                class="text-blue-800 focus:outline-none hover:underline"
                                :href="rowUrl(row)"
                            >
                                <slot
                                    :name="column.field"
                                    :[column.field]="row[column.field]"
                                    :row="row"
                                >
                                    {{ row[column.field] }}
                                </slot>
                            </inertia-link>

                            <slot
                                v-else
                                :name="column.field"
                                :[column.field]="row[column.field]"
                                :row="row"
                            >
                                {{ row[column.field] }}
                            </slot>
                        </td>

                        <td v-else class="px-6 py-4 text-sm" :key="columnIndex">
                            <slot
                                :name="column.field"
                                :[column.field]="row[column.field]"
                                :row="row"
                            >
                                {{ row[column.field] }}
                            </slot>
                            <!-- <component
                                :is="rowsAreClickable ? 'inertia-link' : 'div'"
                                class="block px-6 py-4 focus:outline-none"
                                :href="rowsAreClickable ? rowUrl(row) : false"
                                :tabindex="!rowsAreClickable || columnIndex === 0 ? false : -1"
                            >
                                <slot :name="column.field" :[column.field]="row[column.field]" :row="row">
                                    {{ row[column.field] }}
                                </slot>
                            </component> -->
                        </td>
                    </template>
                </tr>
            </tbody>
        </table>
    </div>

    <pagination v-if="paginate" :meta="collection.meta" />

    <table-empty
        v-if="!collection.data.length"
        :id="collection.properties.model"
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
            rowsAreClickable() {
                if (
                    this.collection.filters.hasOwnProperty('status') &&
                    this.collection.filters.status === 'trashed'
                ) {
                    return false;
                }

                return true;
            },
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
            rowStatus(row) {
                if (
                    !row.hasOwnProperty('status') ||
                    row.status === 'published' ||
                    row.trashed
                ) {
                    return null;
                }

                return this.$t(row.status) + ' &mdash; ';
            },
            rowUrl(row) {
                return this.route(
                    this.collection.properties.route_prefix + '.edit',
                    row
                );
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
