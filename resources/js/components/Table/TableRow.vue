<template>
    <tr>
        <template v-for="(column, columnIndex) in collection.columns">
            <td
                v-if="column.field === 'bulk'"
                :key="`bulk-${columnIndex}`"
                class="w-0 p-5 pr-2.5"
            >
                <form-checkbox
                    v-model="selected"
                    :value="row.id"
                    @update="(checked) => toggleSelect(checked, row)"
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
                <span class="text-gray-900" v-html="rowStatus(row)" />

                <inertia-link
                    v-if="!row.hasOwnProperty('trashed') || !row.trashed"
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
            </td>
        </template>
    </tr>
</template>

<script>
    export default {
        name: 'TableRow',
        props: {
            row: {
                type: Object,
                required: true,
            },
            collection: {},
        },
        setup(props) {
            // console.log(t);

            return {};
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
