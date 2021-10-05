<template>
    <layout :title="$t('form.label', 2)">
        <inertia-table :collection="collection"> </inertia-table>
    </layout>
</template>

<script>
    export default {
        props: {
            collection: Object,
        },
    };
</script>
