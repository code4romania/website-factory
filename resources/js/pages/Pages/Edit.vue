<template>
    <form-container
        :resource="resource"
        :model="model"
        :fields="[
            'title',
            'slug',
            'description',
            'blocks',
            'media',
            'published_at',
        ]"
        :breadcrumbs="[
            {
                label: $t('app.dashboard'),
                url: route('admin.dashboard'),
            },
            {
                label: $tChoice('page.label', 2),
                url: route('admin.pages.index'),
            },
        ]"
    >
        <template #panel="{ form }">
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
                v-model="form.description"
            />

            <form-media
                :label="$t('field.image')"
                v-model:media="form.media"
                accepts="images"
                :limit="1"
            />
        </template>

        <template #content="{ form }">
            <block-list v-model:blocks="form.blocks" />
        </template>
    </form-container>
</template>

<script>
    export default {
        props: {
            resource: Object,
            model: Object,
        },
    };
</script>
