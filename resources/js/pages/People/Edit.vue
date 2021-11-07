<template>
    <layout :breadcrumbs="breadcrumbs" :title="pageTitle">
        <form
            @submit.prevent="form.put(route('admin.people.update', person))"
            class="grid gap-y-8"
        >
            <panel-model action="save" :form="form">
                <div class="space-y-1">
                    <form-input
                        :label="$t('field.name')"
                        v-model="form.name"
                        required
                    />

                    <form-slug
                        :label="$t('field.slug')"
                        name="slug"
                        v-model="form.slug"
                        route-name="front.people.show"
                        route-key="person"
                        :source="form.name"
                        required
                    />
                </div>

                <localized-field
                    field="form-input"
                    :label="$t('field.job_title')"
                    v-model="form.title"
                />

                <localized-field
                    field="form-textarea"
                    :label="$t('field.description')"
                    v-model="form.description"
                />
            </panel-model>
        </form>
    </layout>
</template>

<script>
    import { useForm } from '@/helpers';

    export default {
        props: {
            person: Object,
        },
        setup(props) {
            const form = useForm(
                'edit.person',
                ['name', 'slug', 'title', 'description'],
                props.person
            );

            return {
                form,
            };
        },

        computed: {
            pageTitle() {
                return this.$t('person.action.edit');
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
