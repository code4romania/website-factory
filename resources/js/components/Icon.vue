<template>
    <svg :viewBox="svgViewBoxValues" v-html="svgContent" class="fill-current" />
</template>

<script>
    import { computed } from 'vue';

    export default {
        name: 'Icon',
        props: {
            name: {
                type: String,
                required: true,
            },
        },
        setup(props) {
            const svgString = require(`!raw-loader!remixicon/icons/${props.name}.svg`)
                .default;

            return {
                svgViewBoxValues: computed(() =>
                    svgString
                        ? (/viewBox="([^"]+)"/.exec(svgString) || '')[1]
                        : null
                ),

                svgContent: computed(() =>
                    svgString
                        ? svgString.replace(/^<svg[^>]*>|<\/svg>$/g, '')
                        : null
                ),
            };
        },
    };
</script>
