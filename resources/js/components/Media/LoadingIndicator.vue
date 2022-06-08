<template>
    <div class="absolute inset-0 z-50 w-full h-full bg-white/75">
        <div class="absolute top-0 right-0">
            <icon
                name="System/loader-5-line"
                class="w-20 h-20 text-blue-600 animate-spin"
                alt="Loading..."
            />
        </div>
    </div>
</template>

<script>
    export default {
        name: 'MediaLoadingIndicator',
    };
</script>
