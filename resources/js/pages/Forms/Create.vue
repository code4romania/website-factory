<template>
    <layout :breadcrumbs="breadcrumbs">
        <template #title>{{ pageTitle }}</template>

        <template #sidebar> <form-publisher /> </template>

        ssss
    </layout>
</template>

<script>
    export default {
        props: {
            // forms: Object,
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
                return this.$t('form.action.create');
            },
            breadcrumbs() {
                return [
                    {
                        label: this.$tc('form.label', 2),
                        href: this.route('admin.forms.index'),
                    },
                ];
            },
        },
    };
</script>
