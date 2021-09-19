<template>
    <div
        class="flex flex-col items-center min-h-screen pt-6 bg-gray-100 sm:justify-center sm:pt-0"
    >
        <div>
            <inertia-link href="/">
                <app-logo class="w-20 h-20 text-gray-500 fill-current" />
            </inertia-link>
        </div>

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
