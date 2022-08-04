<template>
    <form-container
        :resource="resource"
        :model="model"
        :fields="[
            'title',
            'slug',
            'description',
            'author',
            'blocks',
            'media',
            'categories',
            'published_at',
        ]"
        :field-types="{
            categories: Array,
        }"
        :breadcrumbs="[
            {
                label: $t('app.dashboard'),
                url: route('admin.dashboard'),
            },
            {
                label: $t('post.subnav.posts'),
                url: route('admin.posts.index'),
            },
        ]"
    >
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
                    route-name="front.posts.show"
                    route-key="post"
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

            <form-input
                type="text"
                name="author"
                :label="$t('field.author')"
                v-model="form.author"
            />

            <form-select-multiple
                name="categories"
                :label="$t('field.categories')"
                v-model="form.categories"
                :options="categories"
                option-value-key="id"
                option-label-key="title"
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
            subnav: Array,
            categories: Array,
        },
    };
</script>
