<template>
    <tr>
        <td class="w-0 py-4 pl-3">
            <form-checkbox v-model="selected" :value="row.id" />
        </td>

        <template v-for="(column, index) in collection.columns">
            <td
                v-if="index === 0"
                :key="`title-${index}`"
                class="px-6 py-4 text-sm font-medium"
            >
                <span
                    v-if="status"
                    class="inline-flex px-2.5 py-0.5 rounded-full text-xs bg-gray-200 text-gray-800 mr-2"
                    v-text="$tChoice(`app.table_status.${status}`, 1)"
                />

                <inertia-link
                    v-if="!row.hasOwnProperty('trashed') || !row.trashed"
                    class="text-blue-800 hover:underline"
                    :href="route(collection.properties.main_action_route, row)"
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

            <td
                v-else
                class="hidden px-6 py-4 text-sm sm:table-cell"
                :key="index"
            >
                <slot
                    :name="column.field"
                    :[column.field]="row[column.field]"
                    :row="row"
                >
                    {{ row[column.field] }}
                </slot>
            </td>
        </template>

        <td class="flex justify-end py-4 pr-3">
            <table-actions :properties="collection.properties" :row="row" />
        </td>
    </tr>
</template>

<script>
    import { computed } from 'vue';

    export default {
        name: 'TableRow',
        props: {
            row: {
                type: Object,
                required: true,
            },
            selected: {
                type: Boolean,
                default: false,
            },
            collection: {},
        },
        emits: ['toggle'],
        setup(props, { emit }) {
            const status = computed(() => {
                if (
                    !props.row.hasOwnProperty('status') ||
                    props.row.status === 'published' ||
                    props.row.trashed
                ) {
                    return null;
                }

                return props.row.status;
            });

            const selected = computed({
                get: () => props.selected,
                set: (value) => {
                    emit('toggle', { id: props.row.id, checked: value });
                },
            });

            return {
                status,
                selected,
            };
        },

        methods: {
            toggleSelect(checked, row) {
                this.$emit;

                if (checked) {
                    this.selected.push(row.id);
                } else {
                    this.selected = this.selected.filter((id) => id !== row.id);
                }
            },
        },
    };
</script>
