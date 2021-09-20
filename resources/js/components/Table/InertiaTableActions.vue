<template>
    <div class="flex items-center justify-between space-x-2">
        <table-filters :collection="collection" />

        <form-button
            type="inertia-link"
            :label="createLabel || $t('app.action.create')"
        />
    </div>
</template>

<script>
    export default {
        name: 'InertiaTableActions',
        props: {
            collection: {
                type: Object,
                required: true,
            },
            createRoute: {
                type: String,
                default: '#',
            },
            createLabel: {
                type: String,
                default: null,
            },
        },
    };
</script>
