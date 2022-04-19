<template>
    <layout :title="$tChoice('language.label', 2)">
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
