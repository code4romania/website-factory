<template>
    <layout :breadcrumbs="breadcrumbs">
        <template #title>{{ pageTitle }}</template>
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
                return this.$t('user.action.create');
            },
            breadcrumbs() {
                return [
                    {
                        label: this.$t('user.label', 2),
                        href: this.route('admin.users.index'),
                    },
                ];
            },
        },
    };
</script>
