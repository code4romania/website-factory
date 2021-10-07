<template>
    <thead class="border-b border-gray-200">
        <tr>
            <!-- bulk -->
            <th class="w-8 pl-3">
                <form-checkbox v-model="selectAll" />
            </th>

            <!-- columns -->
            <th
                class="px-6 py-4 text-left"
                v-for="column in columns"
                :key="`column-${column.field}`"
            >
                <inertia-link
                    v-if="column.sortable"
                    class="flex items-center group focus:outline-none"
                    :href="route(route().current())"
                    :data="sortData(column)"
                >
                    <div
                        class="text-xs font-bold leading-4 tracking-wide text-gray-500 uppercase whitespace-nowrap"
                        v-text="column.label"
                    />

                    <icon
                        v-if="
                            sort.column !== column.field ||
                            sort.direction === 'asc'
                        "
                        name="Editor/sort-asc"
                        :class="sortIconClass(column)"
                    />

                    <icon
                        v-else-if="
                            sort.column === column.field &&
                            sort.direction === 'desc'
                        "
                        name="Editor/sort-desc"
                        :class="sortIconClass(column)"
                    />
                </inertia-link>

                <div
                    v-else
                    class="text-xs font-bold leading-4 tracking-wide text-gray-500 uppercase whitespace-nowrap"
                    v-text="column.label"
                />
            </th>

            <!-- actions -->
            <th class="w-10" />
        </tr>
    </thead>
</template>

<script>
    import { computed } from 'vue';
    import { usePage } from '@inertiajs/inertia-vue3';
    import pickBy from 'lodash/pickBy';

    export default {
        name: 'TableHeader',
        inheritAttrs: false,
        props: {
            columns: {
                type: Array,
                default: () => [],
            },
            sort: {
                type: Object,
                default: () => ({
                    column: null,
                    direction: null,
                }),
            },
            selectAll: {
                type: Boolean,
                default: false,
            },
        },
        emits: ['update:selectAll'],
        setup(props, { emit }) {
            const sortData = (column) => {
                const request = {
                    filters: pickBy(usePage().props.value.filters),
                };

                if (props.sort.column !== column.field) {
                    request.sort = column.field;
                } else if (props.sort.direction === 'asc') {
                    request.sort = `-${column.field}`;
                }

                return request;
            };

            const sortIconClass = (column) => [
                'inline-flex w-4 h-4 ml-2 duration-150 outline-none cursor-pointer transition-color group-focus:outline-none',
                props.sort.column !== column.field
                    ? 'invisible group-hover:visible group-focus:visible text-gray-400'
                    : 'text-blue-500 group-focus:text-blue-600 group-hover:text-blue-500',
            ];

            const selectAll = computed({
                get: () => props.selectAll,
                set: (value) => emit('update:selectAll', value),
            });

            return {
                sortData,
                sortIconClass,
                selectAll,
            };
        },
    };
</script>

