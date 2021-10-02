<template>
    <div class="flex items-center justify-center flex-1">
        <div class="text-center">
            <icon-list class="w-12 h-12 mx-auto text-gray-300 fill-current" />

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
                    <icon-add class="w-5 h-5 mr-2 -ml-1 fill-current" />

                    <span v-text="$t(`${id}.action.create`)" />
                </inertia-link>
            </div>
        </div>
    </div>
</template>

<script>
    import IconAdd from 'remixicon/icons/System/add-line.svg';
    import IconList from 'remixicon/icons/Editor/list-check-2.svg';

    export default {
        name: 'TableEmpty',
        components: {
            IconAdd,
            IconList,
        },
        props: {
            id: String,
            action: String,
        },
    };
</script>
