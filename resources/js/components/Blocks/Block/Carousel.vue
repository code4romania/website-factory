<template>
    <block-repeater component="carousel-item" :items="children" />
</template>

<script>
    import { defineBlock } from '@/helpers';

    export default defineBlock({
        type: 'carousel',
        icon: 'Media/speed-line',
    });
</script>
