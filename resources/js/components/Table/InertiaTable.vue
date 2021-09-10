<template>
    <div class="overflow-x-auto">
        <table class="min-w-full text-gray-900 table-fixed">
            <table-header
                :columns="collection.columns"
                :sort="collection.sort"
                :base-url="headBaseUrl"
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
                            <component
                                :is="showRowUrls ? 'inertia-link' : 'div'"
                                class="block px-6 py-4 focus:outline-none"
                                :href="showRowUrls ? rowUrl(row) : false"
                                :tabindex="
                                    !showRowUrls ||
                                    (columnIndex === 0 ? false : -1)
                                "
                            >
                                <slot
                                    :name="column.field"
                                    :[column.field]="row[column.field]"
                                    :row="row"
                                >
                                    {{ row[column.field] }}
                                </slot>
                            </component>
                        </td>
                    </template>
                </tr>
            </tbody>
        </table>
    </div>

    <pagination v-if="paginate" :meta="collection.meta" />

    <table-empty
        v-if="!collection.data.length"
        :id="id"
        :action="emptyAction"
    />
</template>

<script>
    import { usePage } from '@inertiajs/inertia-vue3';

    import isEmpty from 'lodash/isEmpty';

    export default {
        name: 'InertiaTable',
        props: {
            id: {
                type: String,
                required: true,
            },
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
            sortArgs: {
                type: Object,
                default: () => ({}),
            },
            sortable: {
                type: Boolean,
                default: true,
            },
            showRowUrls: {
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
        },
        data() {
            return {
                selected: [],
            };
        },
        computed: {
            headBaseUrl() {
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
                    console.log(value);
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
                if (isEmpty(this.routeArgs)) {
                    throw `InertiaTable requires the routeArgs prop to be set.`;
                }

                return this.route(
                    this.routeName,
                    this.fillArgs(this.routeArgs, row)
                );
            },
            fillArgs(args, model) {
                let parameters = {};

                Object.entries(args).forEach(([key, prop]) => {
                    parameters[key] = model.hasOwnProperty(prop)
                        ? model[prop]
                        : prop;
                });

                return parameters;
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
