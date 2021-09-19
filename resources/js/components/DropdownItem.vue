<template>
    <inertia-link v-if="type === 'link'" :class="style">
        <slot />
    </inertia-link>

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
        },
        computed: {
            style: () => [
                'block w-full px-4 py-2 text-sm leading-5 text-left text-gray-700 transition duration-150 ease-in-out hover:bg-gray-100 focus:outline-none focus:bg-gray-100',
            ],
        },
    };
</script>
