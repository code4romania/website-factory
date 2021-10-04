<template>
    <div class="flex items-center justify-center flex-1">
        <div class="text-center">
            <icon
                name="Editor/list-check-2"
                class="w-12 h-12 mx-auto text-gray-300"
            />

            <h3
                class="mt-2 text-lg font-medium text-gray-800"
                v-text="$t(`${id}.empty.title`)"
            />

            <p
                class="mt-1 text-sm text-gray-500"
                v-text="$t(`${id}.empty.description`)"
            />

            <div v-if="action" class="mt-6">
                <inertia-link
                    :href="route(action)"
                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                >
                    <icon name="System/add-line" class="w-5 h-5 mr-2 -ml-1" />

                    <span v-text="$t(`${id}.action.create`)" />
                </inertia-link>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'TableEmpty',
        props: {
            id: String,
            action: String,
        },
    };
</script>
