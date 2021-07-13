<template>
    <inertia-link
        :href="href"
        class="inline-flex items-center px-1 pt-1 text-sm font-medium leading-5 transition duration-150 ease-in-out border-b-2 focus:outline-none"
        :class="{
            'border-indigo-400 text-gray-900  focus:border-indigo-700 ': active,
            'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:text-gray-700 focus:border-gray-300': !active,
        }"
    >
        <slot />
    </inertia-link>
</template>

<script>
    export default {
        props: ['href', 'active'],
    };
</script>
