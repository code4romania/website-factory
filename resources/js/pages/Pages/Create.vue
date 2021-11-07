<template>
    <layout :breadcrumbs="breadcrumbs" :title="pageTitle">
        <form
            @submit.prevent="form.post(route('admin.pages.store'))"
            class="grid gap-y-8"
        >
            <panel-model action="save" :form="form">
                <div class="space-y-1">
                    <localized-field
                        field="form-input"
                        :label="$t('field.title')"
                        name="title"
                        v-model="form.title"
                        required
                    />

                    <localized-field
                        field="form-slug"
                        :label="$t('field.slug')"
                        name="slug"
                        v-model="form.slug"
                        route-name="front.pages.show"
                        route-key="page"
                        :source="form.title"
                        translatable
                        required
                    />
                </div>
            </panel-model>

            <block-list v-model:blocks="form.blocks" />
        </form>
    </layout>
</template>

<script>
    import { useForm } from '@/helpers';

    export default {
        setup(props) {
            const form = useForm('create.page', ['title', 'slug', 'blocks']);

            return {
                form,
            };
        },
        computed: {
            pageTitle() {
                return this.$t('page.action.create');
            },
            breadcrumbs() {
                return [
                    {
                        label: this.$t('page.label', 2),
                        href: this.route('admin.pages.index'),
                    },
                ];
            },
        },
    };
</script>
