<template>
    <layout :title="$t(pageTitle)">
        <template #subnav>
            <menu-item
                v-for="(item, index) in subnav"
                :key="index"
                :href="route(item.route)"
                class="text-sm"
                class-active="bg-gray-50 text-gray-900"
                class-inactive="text-gray-900 hover:bg-gray-100 hover:text-gray-900"
            >
                {{ $t(item.label) }}
            </menu-item>
        </template>

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
                        route-name="front.posts.show"
                        route-key="post"
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

                <form-media
                    :label="$t('field.image')"
                    v-model:media="form.media"
                    :limit="1"
                />

                <form-select
                    :label="$t('field.categories')"
                    v-model="form.categories"
                    :options="categories"
                    option-value-key="id"
                    option-label-key="title"
                    multiple
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
            subnav: Array,
            categories: Array,
        },
        setup(props) {
            const action = props.resource === undefined ? 'create' : 'edit';

            const form = useForm(`${action}.post`, props.resource, [
                'title',
                'slug',
                'description',
                'blocks',
                'media',
                'categories',
            ]);

            const method = computed(() => (action === 'edit' ? 'put' : 'post'));
            const url = computed(() =>
                action === 'edit'
                    ? route('admin.posts.update', props.resource)
                    : route('admin.posts.store')
            );

            const pageTitle = computed(() => `post.action.${action}`);

            return {
                form,
                method,
                url,
                pageTitle,
            };
        },
    };
</script>
