<template>
    <layout :title="$t(pageTitle)">
        <form @submit.prevent="form.submit(method, url)" class="grid gap-y-8">
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
                    :label="$t('field.description')"
                    required
                    v-model="form.description"
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
    import { computed } from 'vue';
    import { useForm, route } from '@/helpers';

    export default {
        props: {
            resource: Object,
            model: Object,
        },
        setup(props) {
            const action = props.resource === undefined ? 'create' : 'edit';

            const form = useForm(`${action}.page`, props.resource, [
                'title',
                'slug',
                'description',
                'layout',
                'blocks',
                'media',
                'published_at',
            ]);

            const method = computed(() => (action === 'edit' ? 'put' : 'post'));
            const url = computed(() =>
                action === 'edit'
                    ? route('admin.pages.update', props.resource)
                    : route('admin.pages.store')
            );

            const pageTitle = computed(() => `page.action.${action}`);

            return {
                form,
                method,
                url,
                pageTitle,
            };
        },
    };
</script>
