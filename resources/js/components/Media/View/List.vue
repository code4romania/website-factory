<template>
    <div
        class="grid grid-cols-2 gap-4 sm:grid-cols-3 sm:gap-6 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 2xl:grid-cols-7"
    >
        <media-view-grid-item
            v-for="(item, index) in items"
            :key="index"
            :item="item"
            :selected="selectedItems.includes(item.id)"
            @toggle-selected="$emit('toggle-selected', $event)"
        />
    </div>
</template>

<script>
    export default {
        name: 'MediaViewList',
        props: {
            items: {
                type: Array,
                default: () => [],
            },
            selectedItems: {
                type: Array,
                default: () => [],
            },
        },
        emits: ['toggle-selected'],
        setup(props) {
            return {};
        },
    };
</script>
