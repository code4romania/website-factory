<template>
    <layout
        :title="$tChoice('category.label', 2)"
        :breadcrumbs="[
            {
                label: $t('app.dashboard'),
                url: route('admin.dashboard'),
            },
            {
                label: $t('post.subnav.posts'),
                url: route('admin.posts.index'),
            },
        ]"
    >
        <template #subnav>
            <menu-item
                v-for="(item, index) in subnav"
                :key="index"
                :href="route(item.route)"
                class="text-sm"
                class-active="bg-gray-50 text-gray-900"
                class-inactive="text-gray-900 hover:bg-gray-100 hover:text-gray-900"
            >
                {{ $t(item.label) }}
            </menu-item>
        </template>

        <inertia-table :collection="collection" />
    </layout>
</template>

<script>
    export default {
        props: {
            collection: Object,
            subnav: Array,
        },
    };
</script>
