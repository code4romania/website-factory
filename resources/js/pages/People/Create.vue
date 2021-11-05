<template>
    <layout :breadcrumbs="breadcrumbs" :title="pageTitle">
        <form
            @submit.prevent="form.post(route('admin.people.store'))"
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

                    <form-slug
                        :label="$t('field.slug')"
                        name="slug"
                        v-model="form.slug"
                        route-name="front.people.show"
                        route-key="person"
                        :source="form.title"
                        required
                    />
                </div>
            </panel-model>
        </form>
    </layout>
</template>

<script>
    import { useForm } from '@/helpers';

    export default {
        setup(props) {
            const form = useForm('create.person', ['title', 'slug', 'blocks']);

            return {
                form,
            };
        },
        computed: {
            pageTitle() {
                return this.$t('person.action.create');
            },
            breadcrumbs() {
                return [
                    {
                        label: this.$t('person.label', 2),
                        href: this.route('admin.people.index'),
                    },
                ];
            },
        },
    };
</script>
