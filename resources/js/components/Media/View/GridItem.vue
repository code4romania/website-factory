<template>
    <button
        type="button"
        class="relative bg-white focus:outline-none"
        @click="$emit('toggle-selected', item.id)"
    >
        <div
            class="block w-full overflow-hidden border border-gray-200 group aspect-w-1 aspect-h-1"
            :class="{
                'ring-4 ring-blue-500': selected,
            }"
        >
            <img
                :src="item.urls.thumb"
                class="object-contain object-center transition-opacity duration-150"
                :class="{
                    'group-hover:opacity-75 group-focus:opacity-75': !selected,
                }"
                alt=""
                loading="lazy"
            />
        </div>
    </button>
</template>

<script>
    export default {
        name: 'MediaViewGridItem',
        props: {
            item: {
                type: Object,
                default: () => {},
            },
            selected: {
                type: Boolean,
                default: false,
            },
        },
        emits: ['toggle-selected'],
    };
</script>
