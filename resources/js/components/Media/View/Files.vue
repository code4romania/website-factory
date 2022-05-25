<template>
    <media-uploader @upload="$emit('upload', $event)" />

    <div class="divide-y divide-gray-200">
        <div
            v-for="(item, index) in items"
            :key="`media-view-file-${index}`"
            class="relative flex items-center w-full py-4 text-base bg-white focus:outline-none group disabled:cursor-default disabled:bg-gray-100"
        >
            <div class="min-w-0">
                <form-checkbox
                    :modelValue="isSelected(item)"
                    @update:modelValue="$emit('toggle-selected', item.id)"
                />
            </div>

            <button
                type="button"
                @click="$emit('select', item.id)"
                class="flex flex-1 text-left"
            >
                <div class="flex-1 px-4 sm:px-6">
                    {{ item.filename }}
                </div>

                <div class="justify-end text-right">
                    {{ item.size }}
                </div>
            </button>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'MediaViewFiles',
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
        emits: ['select', 'toggle-selected', 'upload'],
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
