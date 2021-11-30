<template>
    <media-uploader @upload="$emit('upload', $event)" accept="image/*" />

    <div
        class="grid grid-cols-2 gap-4 sm:grid-cols-3 sm:gap-6 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 2xl:grid-cols-7"
    >
        <button
            type="button"
            v-for="(item, index) in items"
            :key="`media-view-image-${index}`"
            class="relative bg-white focus:outline-none group disabled:cursor-default disabled:bg-gray-100"
            :disabled="isDisabled(item)"
            @click="$emit('toggle-selected', item.id)"
        >
            <div
                class="block w-full overflow-hidden border border-gray-200 aspect-w-1 aspect-h-1"
                :class="{
                    'ring-4 ring-blue-500': isSelected(item),
                }"
            >
                <img
                    :src="item.sizes.thumb.url"
                    class="object-contain object-center transition-opacity duration-150 select-none group-disabled:opacity-50"
                    :class="{
                        'group-hover:opacity-75 group-focus:opacity-75':
                            !isSelected(item) && !isDisabled(item),
                    }"
                    loading="lazy"
                    draggable="false"
                    alt=""
                />
            </div>
        </button>
    </div>
</template>

<script>
    export default {
        name: 'MediaViewImages',
        props: {
            items: {
                type: Array,
                default: () => [],
            },
            selectedItems: {
                type: Array,
                default: () => [],
            },
            disabledItems: {
                type: Array,
                default: () => [],
            },
        },
        emits: ['toggle-selected', 'upload'],
        setup(props) {
            const isSelected = (item) =>
                props.selectedItems.some((i) => i.id === item.id);

            const isDisabled = (item) => props.disabledItems.includes(item.id);

            return {
                isSelected,
                isDisabled,
            };
        },
    };
</script>
