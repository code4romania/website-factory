<template>
    <button
        type="button"
        class="relative bg-white focus:outline-none group disabled:cursor-default disabled:bg-gray-100"
        :disabled="disabled"
        @click="$emit('toggle-selected', item.id)"
    >
        <div
            class="block w-full overflow-hidden border border-gray-200 aspect-w-1 aspect-h-1"
            :class="{
                'ring-4 ring-blue-500': selected,
            }"
        >
            <img
                :src="item.sizes.thumb.url"
                class="object-contain object-center transition-opacity duration-150 select-none group-disabled:opacity-50"
                :class="{
                    'group-hover:opacity-75 group-focus:opacity-75':
                        !selected && !disabled,
                }"
                loading="lazy"
                draggable="false"
                alt=""
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
            disabled: {
                type: Boolean,
                default: false,
            },
        },
        emits: ['toggle-selected'],
    };
</script>
