<template>
    <layout :breadcrumbs="breadcrumbs" :title="pageTitle">
        <form
            @submit.prevent="form.put(route('admin.pages.update', page))"
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

                <localized-field
                    field="form-editor"
                    :label="$t('field.text')"
                    required
                    v-model="form.text"
                />

                <form-select
                    :label="$t('field.layout')"
                    v-model="form.layout"
                    :options="model.layouts"
                />

                <form-media
                    :label="$t('field.image')"
                    v-model:media="form.media"
                    :limit="1"
                />
            </panel-model>

            <block-list v-model:blocks="form.blocks" />
        </form>
    </layout>
</template>

<script>
    import { useForm } from '@/helpers';

    export default {
        props: {
            page: Object,
            model: Object,
        },
        setup(props) {
            const form = useForm(
                'edit.page',
                ['title', 'slug', 'layout', 'blocks', 'media'],
                props.page
            );

            return {
                form,
            };
        },

        computed: {
            pageTitle() {
                return this.$t('page.action.edit');
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
