<template>
    <th :class="outerStyle">
        <form-checkbox v-if="column.field === 'bulk'" v-model="selectedAll" />

        <inertia-link
            v-else-if="isSortable"
            class="flex items-center group focus:outline-none"
            :href="route(route().current())"
            :data="columnData"
        >
            <div :class="innerStyle" v-text="column.label" />

            <icon
                v-if="
                    currentSortField !== field ||
                    (currentSortField === field && isOrderAsc)
                "
                name="Editor/sort-asc"
                :class="sortIconClass"
            />

            <icon
                v-else-if="currentSortField === field && isOrderDesc"
                name="Editor/sort-desc"
                :class="sortIconClass"
            />
        </inertia-link>

        <div v-else :class="innerStyle" v-text="column.label" />
    </th>
</template>

<script>
    import pickBy from 'lodash/pickBy';
    import { usePage } from '@inertiajs/inertia-vue3';

    export default {
        name: 'TableHead',

        props: {
            column: {
                type: Object,
                required: true,
            },
            selectedAll: {
                type: Boolean,
                default: false,
            },
            currentSortField: {
                type: String,
                default: null,
            },
            currentSortDirection: {
                type: String,
                default: null,
            },
        },
        computed: {
            component() {
                return this.isSortable ? 'inertia-link' : 'div';
            },
            field() {
                return this.column.field.replace('___', '.');
            },
            isSortable() {
                return (
                    this.column.hasOwnProperty('sortable') && this.column.sortable
                );
            },
            isOrderAsc() {
                return this.currentSortDirection === 'asc';
            },
            isOrderDesc() {
                return this.currentSortDirection === 'desc';
            },
            sortIconClass() {
                return [
                    'inline-flex w-4 h-4 ml-2 duration-150 outline-none cursor-pointer transition-color group-focus:outline-none',
                    this.currentSortField !== this.field
                        ? 'invisible group-hover:visible group-focus:visible text-gray-400'
                        : 'text-blue-500 group-focus:text-blue-600 group-hover:text-blue-500',
                ];
            },
            columnData() {
                if (!this.isSortable) {
                    return false;
                }

                const response = {
                    filters: pickBy(usePage().props.value.filters),
                };

                if (
                    !this.currentSortField === this.field ||
                    this.currentSortDirection === null
                ) {
                    response.sort = this.field;
                } else if (this.isOrderAsc) {
                    response.sort = `-${this.field}`;
                }

                return response;
            },
            outerStyle() {
                if (['bulk', 'actions'].includes(this.column.field)) {
                    return 'w-0 p-5 pr-2.5';
                }

                return 'px-6 py-5 text-left';
            },
            innerStyle() {
                return 'text-xs font-bold leading-4 tracking-wide text-gray-500 uppercase  whitespace-nowrap';
            },
        },
    };
</script>

