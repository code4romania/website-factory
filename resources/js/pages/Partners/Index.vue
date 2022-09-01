<template>
    <layout
        :title="$tChoice('partner.label', 2)"
        :breadcrumbs="[
            {
                label: $t('app.dashboard'),
                url: route('admin.dashboard'),
            },
        ]"
    >
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
