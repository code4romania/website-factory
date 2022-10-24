<template>
    <svg class="fill-current" aria-hidden="true">
        <use :href="symbolId" />
    </svg>
</template>

<script>
    import { computed } from 'vue';

    export default {
        name: 'Icon',
        props: {
            prefix: {
                type: String,
                default: 'icon',
            },
            name: {
                type: String,
                required: true,
            },
        },
        setup(props) {
            const symbolId = computed(() => `#${props.prefix}-${props.name}`);

            return {
                symbolId,
            };
        },
    };
</script>
