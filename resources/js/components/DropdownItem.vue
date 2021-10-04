<template>
    <inertia-link v-if="type === 'link' && !target" :class="style">
        <slot />
    </inertia-link>

    <a v-else-if="type === 'link' && target" :target="target" :class="style">
        <slot />
    </a>

    <button type="button" v-else-if="type === 'button'" :class="style">
        <slot />
    </button>
</template>

<script>
    export default {
        name: 'DropdownItem',
        props: {
            type: {
                type: String,
                default: 'link',
                validator: (value) => ['link', 'button'].includes(value),
            },
            target: {
                type: String,
                default: null,
            },
        },
        computed: {
            style: () => [
                'flex w-full px-4 py-2 text-sm text-left text-gray-700 transition duration-150 ease-in-out group hover:bg-gray-100 hover:text-gray-900 focus:outline-none focus:bg-gray-100 focus:text-gray-900',
            ],
        },
    };
</script>
