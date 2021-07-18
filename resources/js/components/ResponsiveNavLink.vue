<template>
    <inertia-link
        class="block py-2 pl-3 pr-4 text-base font-medium transition duration-150 ease-in-out border-l-4 focus:outline-none"
        :class="{
            'border-indigo-400 text-indigo-700 bg-indigo-50 focus:text-indigo-800 focus:bg-indigo-100 focus:border-indigo-700': active,
            'border-transparent text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300': !active,
        }"
    >
        <slot />
    </inertia-link>
</template>

<script>
    export default {
        name: 'ResponsiveNavLink',
        props: ['active'],
    };
</script>
