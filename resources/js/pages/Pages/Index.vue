<template>
    <layout :title="$tc('page.label', 2)">
        <inertia-table :collection="collection">
            <template #title="{ title }">
                {{ title }}
            </template>
        </inertia-table>
    </layout>
</template>

<script>
    export default {
        props: {
            collection: Object,
        },
    };
</script>
