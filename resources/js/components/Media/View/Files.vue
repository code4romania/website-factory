<template>
    <media-uploader @upload="$emit('upload', $event)" />

    <div class="divide-y divide-gray-200">
        <button
            type="button"
            v-for="(item, index) in items"
            :key="`media-view-file-${index}`"
            class="relative flex items-center w-full py-4 text-base text-left bg-white focus:outline-none group disabled:cursor-default disabled:bg-gray-100"
            @click="$emit('toggle-selected', item.id)"
        >
            <!-- <div class="min-w-0">
                <form-checkbox v-model="isSelected(item)" />
            </div> -->

            <div class="flex-1 px-4 sm:px-6">
                {{ item.filename }}
            </div>

            <div class="justify-end text-right">
                {{ item.size }}
            </div>
        </button>
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
