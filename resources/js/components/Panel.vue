<template>
    <div class="bg-white shadow shrink-0">
        <div
            v-if="title"
            class="px-4 py-4 border-b border-gray-200 sm:px-6 bg-gray-50"
        >
            <h2 class="font-semibold text-gray-900" v-text="title" />
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
