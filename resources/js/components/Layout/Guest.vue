<template>
    <div
        class="flex flex-col items-center min-h-screen pt-6 transition-opacity duration-200 sm:justify-center sm:pt-0"
        :class="{ 'opacity-0': !isLoaded() }"
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
    import { isLoaded } from 'laravel-vue-i18n';

    export default {
        name: 'LayoutGuest',
        setup() {
            return {
                isLoaded,
            };
        },
    };
</script>
