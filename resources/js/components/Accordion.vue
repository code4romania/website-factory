<template>
    <div class="text-sm">
        <button
            type="button"
            class="flex items-center w-full px-5 py-4 hover:bg-blue-50"
            :class="{ 'bg-blue-50': open }"
            @click="toggle"
        >
            <slot name="title" />

            <span class="flex justify-end flex-1 text-right text-gray-400">
                <slot name="value" />
            </span>

            <icon
                name="System/arrow-down-s-line"
                class="w-5 h-5 text-gray-400"
                :class="{ 'rotate-180': open }"
            />
        </button>

        <div v-if="open" class="px-5 py-4 bg-gray-50">
            <slot />
        </div>
    </div>
</template>

<script>
    import { ref } from 'vue';

    export default {
        name: 'Accordion',
        props: {
            open: {
                type: Boolean,
                default: false,
            },
        },
        setup(props) {
            const open = ref(props.open);

            const toggle = () => (open.value = !open.value);

            return {
                open,
                toggle,
            };
        },
    };
</script>
