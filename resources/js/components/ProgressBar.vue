<template>
    <div class="flex w-full bg-gray-200">
        <div
            class="max-w-full duration-150 bg-blue-600 transition-width"
            :style="{
                width: value + '%',
            }"
        />
    </div>
</template>

<script>
    export default {
        name: 'ProgressBar',
        props: {
            value: {
                type: Number,
                default: 0,
            },
        },
    };
</script>
