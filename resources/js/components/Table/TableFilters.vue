<template>
    <div>
        <dropdown
            trigger-class="flex items-center justify-between w-full px-1 py-4 -mb-px text-sm font-medium text-gray-500 border-b-2 border-transparent border-gray-200 whitespace-nowrap hover:text-gray-700 hover:border-gray-300 focus:text-gray-700 focus:border-gray-300"
            class="sm:hidden"
            with-arrow
        >
            <template #trigger>
                <div class="flex justify-start flex-1">
                    <span
                        v-text="$tChoice(`app.table_status.${current.name}`, 2)"
                    />

                    <span
                        v-text="current.count"
                        class="ml-3 mr-1 py-0.5 px-2.5 rounded-full text-xs font-semibold bg-gray-200 text-gray-900"
                    />
                </div>
            </template>

            <template #content>
                <dropdown-item
                    v-for="(status, index) in collection.statuses"
                    :key="index"
                    :href="filterUrl(status)"
                    class="flex items-center justify-between"
                >
                    <span
                        v-text="$tChoice(`app.table_status.${status.name}`, 2)"
                    />

                    <span
                        class="text-xs font-semibold text-gray-900"
                        v-text="status.count"
                    />
                </dropdown-item>
            </template>
        </dropdown>

        <nav class="hidden space-x-6 sm:flex sm:justify-end">
            <inertia-link
                v-for="status in collection.statuses"
                :key="status.name"
                :href="filterUrl(status)"
                class="flex px-1 py-4 text-sm font-medium border-b-2 whitespace-nowrap -mb-0.5"
                :class="
                    isCurrent(status)
                        ? 'border-blue-500 text-blue-600'
                        : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-200'
                "
            >
                <span v-text="$tChoice(`app.table_status.${status.name}`, 2)" />

                <span
                    v-text="status.count"
                    class="hidden ml-3 py-0.5 px-2.5 rounded-full text-xs sm:inline-block font-semibold"
                    :class="
                        isCurrent(status)
                            ? 'bg-blue-100 text-blue-600'
                            : 'bg-gray-200 text-gray-900'
                    "
                />
            </inertia-link>
        </nav>
    </div>
</template>

<script>
    import { computed } from 'vue';
    import { usePage } from '@inertiajs/inertia-vue3';
    import get from 'lodash/get';

    export default {
        name: 'TableFilters',
        props: {
            collection: {
                type: Object,
                required: true,
            },
        },
        setup(props) {
            const current = computed(() => {
                const current = get(props.collection, 'filters.status');

                const status = props.collection.statuses.find(
                    (status) => status.name === current
                );

                if (typeof status === 'undefined') {
                    return props.collection.statuses[0];
                }

                return status;
            });

            return {
                current,
            };
        },
        methods: {
            isCurrent(status) {
                return this.current.name === status.name;
            },
            filterUrl(status) {
                return this.route(usePage().props.value.route, {
                    filter: { status: status.name },
                });
            },
        },
    };
</script>
