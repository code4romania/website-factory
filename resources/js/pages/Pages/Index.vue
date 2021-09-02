<template>
    <layout :title="$tc('page.label', 2)">
        <inertia-table
            id="page"
            route-name="admin.pages.edit"
            :route-args="{ page: 'id' }"
            :collection="pages"
        >
            <template #title="{ title }">
                {{ title }}
            </template>
        </inertia-table>
    </layout>
</template>

<script>
    export default {
        props: {
            pages: Object,
        },
    };
</script>
