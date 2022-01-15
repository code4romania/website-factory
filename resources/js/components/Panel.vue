<template>
    <div class="overflow-hidden bg-white shadow shrink-0">
        <div v-if="title" class="px-4 py-4 bg-gray-200 sm:px-6">
            <h2 class="text-lg font-medium text-gray-900" v-text="title" />
        </div>
        <div class="relative px-4 py-5 space-y-8 sm:p-6">
            <slot />
        </div>
    </div>
</template>

<script>
    export default {
        name: 'Panel',
        props: {
            title: {
                type: String,
                default: null,
            },
        },
    };
</script>
