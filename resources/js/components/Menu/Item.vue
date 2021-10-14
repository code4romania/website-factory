<template>
    <inertia-link
        v-if="type === 'link' && !target"
        :class="{
            [classBase]: true,
            [classActive]: isCurrentUrl,
            [classInactive]: !isCurrentUrl,
        }"
        :as="method === 'post' ? 'button' : 'a'"
        :method="method"
        :href="href"
    >
        <slot />
    </inertia-link>

    <a
        v-else-if="type === 'link' && target"
        :class="{
            [classBase]: true,
            [classActive]: isCurrentUrl,
            [classInactive]: !isCurrentUrl,
        }"
        :href="href"
    >
        <slot />
    </a>

    <button
        v-else-if="type === 'button'"
        type="button"
        :class="[classBase, classInactive]"
        @click="onClick"
    >
        <slot />
    </button>
</template>

<script>
    import { computed } from 'vue';

    import { usePage } from '@inertiajs/inertia-vue3';

    export default {
        name: 'MenuItem',
        props: {
            type: {
                type: String,
                default: 'link',
                validator: (value) => ['link', 'button'].includes(value),
            },
            href: {
                type: String,
                default: null,
            },
            target: {
                type: String,
                default: null,
            },
            method: {
                type: String,
                default: 'get',
            },
            onClick: {
                type: Function,
                default: () => {},
            },
            classBase: {
                type: String,
                default: 'flex px-3 py-2 font-medium',
            },
            classActive: {
                type: String,
                default: 'bg-gray-900 text-white',
            },
            classInactive: {
                type: String,
                default: `text-gray-300 hover:bg-gray-700 hover:text-white focus:bg-gray-700 focus:text-white`,
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
        },
    };
</script>

