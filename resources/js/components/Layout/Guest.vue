<template>
    <div
        class="flex flex-col items-center min-h-screen pt-6 bg-gray-100 sm:justify-center sm:pt-0"
    >
        <app-logo class="h-20 text-gray-500 sm:max-w-md" />

        <div
            class="w-full px-6 py-4 mt-6 overflow-hidden bg-white shadow-md sm:max-w-md"
        >
            <slot />
        </div>
    </div>
</template>

<script>
    export default {
        name: 'LayoutGuest',
    };
</script>
