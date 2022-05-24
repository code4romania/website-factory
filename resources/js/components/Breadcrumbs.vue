<template>
    <div class="min-h-5">
        <nav class="sm:hidden" aria-label="Back">
            <inertia-link
                v-if="items.length"
                :href="back.href"
                class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700"
            >
                <icon
                    name="System/arrow-drop-left-line"
                    class="w-5 h-5 mr-1 -ml-1 text-gray-500 shrink-0"
                />

                <span v-text="back.label" />
            </inertia-link>
        </nav>

        <nav class="hidden sm:flex" aria-label="Breadcrumb">
            <ol class="flex items-center space-x-4">
                <li
                    v-for="(item, index) in items"
                    :key="index"
                    class="flex items-center"
                >
                    <icon
                        v-if="index > 0"
                        name="System/arrow-drop-right-line"
                        class="w-5 h-5 mr-4 text-gray-500 shrink-0"
                    />

                    <component
                        :is="item.url ? 'inertia-link' : 'span'"
                        class="text-sm font-medium text-gray-500"
                        :class="item.url ? 'hover:text-gray-700' : ''"
                        :href="item.url"
                        v-text="item.label"
                    />
                </li>
            </ol>
        </nav>
    </div>
</template>

<script>
    import { computed } from 'vue';

    export default {
        name: 'Breadcrumbs',
        props: {
            items: {
                type: Array,
                default: () => [],
            },
        },
        setup(props) {
            const items = computed(() => props.items);
            const back = computed(() => items.value[items.value.length - 1]);

            return {
                items,
                back,
            };
        },
    };
</script>
