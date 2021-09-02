<template>
    <layout :breadcrumbs="breadcrumbs" :title="pageTitle">
        <div class="flex flex-col gap-8 mb-8 md:flex-row-reverse">
            <panel-placeholder
                label="Publisher controls: draft/published, dates, save button"
                class="md:w-56 lg:w-96"
            />
            <panel-placeholder
                label="Page properties: title, description etc."
                class="flex-1"
            />
        </div>

        <block-list />
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
                return this.$t('page.action.create');
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
