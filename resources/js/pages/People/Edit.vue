<template>
    <layout :title="$t(pageTitle)">
        <form @submit.prevent="form.submit(method, url)" class="grid gap-y-8">
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
    import { computed } from 'vue';
    import { useForm, route } from '@/helpers';

    export default {
        props: {
            person: Object,
            model: Object,
        },
        setup(props) {
            const action = props.person === undefined ? 'create' : 'edit';

            const form = useForm(`${action}.person`, props.person, [
                'name',
                'slug',
                'title',
                'description',
                'blocks',
                'media',
            ]);

            const method = computed(() => (action === 'edit' ? 'put' : 'post'));
            const url = computed(() =>
                action === 'edit'
                    ? route('admin.people.update', props.person)
                    : route('admin.people.store')
            );

            const pageTitle = computed(() => `person.action.${action}`);

            return {
                form,
                method,
                url,
                pageTitle,
            };
        },
    };
</script>
