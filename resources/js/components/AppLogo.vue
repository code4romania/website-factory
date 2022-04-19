<template>
    <component
        :is="link ? 'inertia-link' : 'div'"
        :href="link ? route('admin.dashboard') : null"
        :class="{
            'hover:opacity-75 transition-opacity duration-150': link,
        }"
    >
        <icon name="logo" class="h-full" local />
    </component>
</template>

<script>
    export default {
        name: 'AppLogo',
        props: {
            link: {
                type: Boolean,
                default: false,
            },
        },
    };
</script>
