<template>
    <div class="min-h-5">
        <nav class="sm:hidden" aria-label="Back">
            <inertia-link
                v-if="normalizedItems.length"
                :href="back.href"
                class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700"
            >
                <img
                    src="remixicon/icons/System/arrow-drop-left-line.svg"
                    class="flex-shrink-0 w-5 h-5 mr-1 -ml-1 text-gray-500 fill-current"
                    svg-inline
                />

                <span v-text="back.label" />
            </inertia-link>
        </nav>

        <nav class="hidden sm:flex" aria-label="Breadcrumb">
            <ol class="flex items-center space-x-4">
                <li
                    v-for="(item, index) in normalizedItems"
                    :key="index"
                    class="flex items-center"
                >
                    <img
                        v-if="index > 0"
                        src="remixicon/icons/System/arrow-drop-right-line.svg"
                        class="flex-shrink-0 w-5 h-5 mr-4 text-gray-500 fill-current"
                        svg-inline
                    />

                    <component
                        :is="item.href ? 'inertia-link' : 'span'"
                        class="text-sm font-medium text-gray-500"
                        :class="item.href ? 'hover:text-gray-700' : ''"
                        :href="item.href"
                        v-text="item.label"
                    />
                </li>
            </ol>
        </nav>
    </div>
</template>

<script>
    export default {
        name: 'Breadcrumbs',
        props: {
            items: {
                type: Array,
                default: () => [],
            },
        },
        computed: {
            normalizedItems() {
                return this.items
                    .map((item) => ({
                        label: item.label || false,
                        href: item.href || false,
                    }))
                    .filter((item) => !!item.label);
            },
            back() {
                return this.items[this.items.length - 1];
            },
        },
    };
</script>
