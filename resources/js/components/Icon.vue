<template>
    <svg
        :viewBox="viewBox"
        v-html="content"
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
            const svgString = (props.local === true
                ? require(`~/svg/${props.name}.svg`)
                : require(`remixicon/icons/${props.name}.svg`)
            ).default;

            const viewBox = computed(
                () => (/viewBox="([^"]+)"/.exec(svgString) || '')[1]
            );

            const content = computed(() =>
                svgString.replace(
                    /^(<template>)?<svg[^>]*>|<\/svg>(<\/template>)?$/g,
                    ''
                )
            );

            return {
                viewBox,
                content,
            };
        },
    };
</script>
