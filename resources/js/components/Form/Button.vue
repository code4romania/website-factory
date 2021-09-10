<template>
    <button
        :type="type"
        class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-gray-800 border border-transparent rounded-md focus:shadow-outline-gray hover:bg-gray-700 active:bg-gray-900 focus:border-gray-900 focus:outline-none disabled:opacity-50 disabled:cursor-default"
    >
        <slot>{{ label }}</slot>
    </button>
</template>

<script>
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
        },
    };
</script>
