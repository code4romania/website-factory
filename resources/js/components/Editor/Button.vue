<template>
    <button
        v-if="isVisible ? isVisible() : true"
        type="button"
        @click="action"
        :disabled="isDisabled ? isDisabled() : false"
        class="inline-flex px-1 py-1 rounded-sm hover:bg-gray-300 focus:bg-gray-300 disabled:opacity-50 disabled:cursor-default disabled:bg-transparent"
        :class="{ 'bg-gray-200': isActive ? isActive() : false }"
    >
        <component :is="icon" class="w-5 h-5 fill-current" />
    </button>
</template>

<script>
    export default {
        name: 'EditorButton',
        props: {
            icon: {
                type: Object,
                default: () => ({}),
            },
            action: {
                type: Function,
                required: true,
            },
            isActive: {
                type: Function,
                default: null,
            },
            isDisabled: {
                type: Function,
                default: null,
            },
            isVisible: {
                type: Function,
                default: null,
            },
        },
    };
</script>
