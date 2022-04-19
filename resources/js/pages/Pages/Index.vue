<template>
    <layout :title="$tChoice('page.label', 2)">
        <inertia-table :collection="collection" />
    </layout>
</template>

<script>
    export default {
        props: {
            collection: Object,
        },
    };
</script>
