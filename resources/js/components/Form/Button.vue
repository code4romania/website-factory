<template>
    <button
        :type="type"
        class="relative inline-flex items-center justify-center font-semibold tracking-wider transition duration-150 ease-in-out border border-transparent focus:outline-none focus:ring-2 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-default"
        :class="[size, color]"
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
            color: {
                type: String,
                default: 'black',
                validator: (color) =>
                    ['green', 'red', 'blue', 'black', 'white'].includes(color),
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

            const color = computed(
                () =>
                    ({
                        green: `text-white bg-green-600 hover:bg-green-700 focus:ring-green-500`,
                        red: `text-white bg-red-600 hover:bg-red-700 focus:ring-red-500`,
                        blue: `text-white bg-blue-600 hover:bg-blue-700 focus:ring-blue-500`,
                        black: `text-white bg-gray-800 hover:bg-gray-700 focus:ring-blue-500`,
                        white: `border-gray-300 text-gray-700 bg-white hover:bg-gray-50 focus:ring-blue-500`,
                    }[props.color])
            );

            return {
                size,
                color,
            };
        },
    };
</script>
