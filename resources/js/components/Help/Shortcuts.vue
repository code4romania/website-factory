<template>
    <div class="container flex justify-end">
        <dropdown
            origin="top-right"
            trigger-class="flex items-center justify-center w-full px-4 py-2 text-xs font-medium text-gray-700 border border-t-0 border-gray-300 shadow-sm md:text-sm bg-gray-50 hover:bg-white focus:outline-none focus:ring-inset focus:ring-2 focus:ring-blue-500"
            icon-class="ml-1 -mr-1.5"
            with-arrow
            absolute
        >
            <template #trigger>
                <span v-text="$t('help.label')" />
            </template>

            <template #content>
                <div class="divide-y divide-gray-100">
                    <div class="py-1">
                        <dropdown-item
                            :href="route('admin.help.index')"
                            v-text="$t('help.label')"
                        />
                    </div>
                </div>
            </template>
        </dropdown>
    </div>
</template>

<script>
    export default {
        name: 'HelpShortcuts',
        props: {
            //
        },
        setup(props) {
            // TODO: load help shortcuts based on current view
        },
    };
</script>
