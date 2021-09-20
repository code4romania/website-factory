<template>
    <component
        v-if="visible"
        :is="isExternal ? 'a' : 'inertia-link'"
        :href="href"
        class="flex px-3 py-2 font-medium"
        :class="{
            [classActive]: isCurrentUrl,
            [classInactive]: !isCurrentUrl,
        }"
        v-html="label"
    />
</template>

<script>
    import { computed } from 'vue';

    import { usePage } from '@inertiajs/inertia-vue3';

    export default {
        name: 'MenuItem',
        props: {
            href: {
                type: String,
                default: null,
            },
            routeName: {
                type: String,
                default: null,
            },
            label: {
                type: String,
                required: true,
            },
            classActive: {
                type: String,
                default: 'bg-gray-900 text-white',
            },
            classInactive: {
                type: String,
                default: `text-gray-300 hover:bg-gray-700 hover:text-white focus:bg-gray-700 focus:text-white`,
            },
            visible: {
                type: Boolean,
                default: true,
            },
        },
        setup(props) {
            const isCurrentRoute = computed(
                () => usePage().props.value.route === props.route
            );

            return {
                isCurrentRoute,
            };
        },

        computed: {
            isCurrentUrl() {
                const currentUrl = location.origin + location.pathname;

                if (this.href === this.route('admin.dashboard')) {
                    return this.href === currentUrl.replace(/\/$/, '');
                }

                return currentUrl.startsWith(this.href);
            },
            isExternal() {
                return false;
            },
        },
    };
</script>

