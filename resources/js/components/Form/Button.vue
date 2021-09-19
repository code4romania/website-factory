<template>
    <button
        :type="type"
        class="relative inline-flex items-center justify-center font-semibold tracking-wider transition duration-150 ease-in-out border border-transparent focus:outline-none focus:ring-2 focus:ring-offset-2"
        :class="[
            size,
            'text-white uppercase bg-gray-800 hover:bg-gray-700 active:bg-gray-900 focus:border-gray-900 disabled:opacity-50 disabled:cursor-default',
        ]"
    >
        <slot>{{ label }}</slot>
    </button>
</template>

<script>
    import { computed } from 'vue';

    export default {
        name: 'FormButton',
        props: {
            type: {
                type: String,
                default: 'submit',
            },
            label: {
                type: String,
                default: null,
            },
            size: {
                type: String,
                default: 'md',
                validator: (size) => ['xs', 'sm', 'md', 'lg', 'xl'].includes(size),
            },
        },
        setup(props) {
            const size = computed(
                () =>
                    ({
                        xs: 'text-xs px-2.5 py-1.5',
                        sm: 'text-sm px-3 py-2',
                        md: 'text-sm px-4 py-2',
                        lg: 'text-base px-4 py-2',
                        xl: 'text-base px-6 py-3',
                    }[props.size])
            );

            return {
                size,
            };
        },
    };
</script>
