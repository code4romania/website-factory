<template>
    <layout :title="$t('app.dashboard')">
        <dl
            class="grid grid-cols-1 mt-5 overflow-hidden bg-white divide-y divide-gray-200 rounded-lg shadow md:divide-x md:grid-cols-2 lg:grid-cols-4 lg:divide-y-0"
        >
            <inertia-link
                v-for="item in stats"
                :key="item.type"
                class="px-4 py-5 text-gray-500 sm:p-6 hover:text-blue-600 group"
                :href="route(item.route)"
            >
                <div class="flex items-center mb-1">
                    <dt
                        class="font-medium truncate"
                        v-text="$tChoice(`${item.type}.label`, 2)"
                    />

                    <icon
                        name="System/arrow-right-line"
                        class="shrink-0 w-4 h-4 ml-2 opacity-0 group-hover:opacity-100"
                    />
                </div>

                <dd
                    class="text-4xl font-bold text-blue-600 truncate"
                    v-text="item.count"
                />
            </inertia-link>
        </dl>
    </layout>
</template>

<script>
    export default {
        props: {
            stats: Array,
        },
    };
</script>
