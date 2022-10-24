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
            const svgString = computed(
                () => {
                    if (props.local) {
                        return import(`~/svg/${props.name}.svg`);
                    }

                    return import(`remixicon/icons/${props.name}.svg`);
                }
                // (props.local === true
                //     ? import(`~/svg/${props.name}.svg`)
                //     : import(`remixicon/icons/${props.name}.svg`)
                // ).default
            );

            const viewBox = computed(
                () => (/viewBox="([^"]+)"/.exec(svgString.value) || '')[1]
            );

            const content = computed(() =>
                svgString.value.replace(
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
