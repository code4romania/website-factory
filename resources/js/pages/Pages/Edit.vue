<template>
    <layout :breadcrumbs="breadcrumbs" :title="pageTitle">
        <form
            @submit.prevent="form.put(route('admin.pages.update', page))"
            class="grid gap-y-8"
        >
            <panel-model action="save" :form="form">
                <div class="space-y-1">
                    <localized-field
                        type="form-input"
                        :label="$t('field.title')"
                        name="title"
                        v-model="form.title"
                        required
                    />

                    <localized-field
                        type="form-slug"
                        :label="$t('field.slug')"
                        name="slug"
                        v-model="form.slug"
                        route-name="front.pages.show"
                        :source="form.title"
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
        props: {
            page: Object,
        },
        setup(props) {
            const form = useForm(
                'edit.page',
                ['title', 'slug', 'blocks'],
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
