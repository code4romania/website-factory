<template>
    <svg
        :viewBox="svgViewBoxValues"
        v-html="svgContent"
        class="fill-current"
        aria-hidden="true"
    />
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
            local: {
                type: Boolean,
                default: false,
            },
        },
        setup(props) {
            const svgString = (
                props.local === true
                    ? require(`!raw-loader!~/svg/${props.name}.svg`)
                    : require(`!raw-loader!remixicon/icons/${props.name}.svg`)
            ).default;

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
