<template>
    <layout :breadcrumbs="breadcrumbs">
        <template #title>{{ pageTitle }}</template>

        <form-publisher />

        ssss
    </layout>
</template>

<script>
    export default {
        props: {
            page: Object,
        },
        data() {
            return {
                form: this.$inertia.form({
                    //
                }),
            };
        },
        computed: {
            pageTitle() {
                return this.$t('page.action.edit');
            },
            breadcrumbs() {
                return [
                    {
                        label: this.$tc('page.label', 2),
                        href: this.route('admin.pages.index'),
                    },
                ];
            },
        },
    };
</script>
