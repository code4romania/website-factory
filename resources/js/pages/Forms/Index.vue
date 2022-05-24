<template>
    <layout
        :title="$tChoice('form.label', 2)"
        :breadcrumbs="[
            {
                label: $t('app.dashboard'),
                url: route('admin.dashboard'),
            },
        ]"
    >
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
