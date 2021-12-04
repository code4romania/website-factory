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
            <panel-model action="save" :form="form" no-publisher>
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
                        route-name="front.post_categories.show"
                        route-key="post_category"
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
            </panel-model>
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
        },
        setup(props) {
            const action = props.resource === undefined ? 'create' : 'edit';

            const form = useForm(`${action}.post_category`, props.resource, [
                'title',
                'slug',
                'description',
            ]);

            const method = computed(() => (action === 'edit' ? 'put' : 'post'));
            const url = computed(() =>
                action === 'edit'
                    ? route('admin.post_categories.update', props.resource)
                    : route('admin.post_categories.store')
            );

            const pageTitle = computed(() => `category.action.${action}`);

            return {
                form,
                method,
                url,
                pageTitle,
            };
        },
    };
</script>
