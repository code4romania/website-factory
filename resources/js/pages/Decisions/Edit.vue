<template>
    <form-container
        :resource="resource"
        :model="model"
        :fields="[
            'title',
            'slug',
            'description',
            'layout',
            'blocks',
            'media',
            'categories',
            'authors',
            'number',
            'date',
            'published_at',
        ]"
        :field-types="{
            categories: Array,
            authors: Array,
        }"
        :breadcrumbs="[
            {
                label: $t('app.dashboard'),
                url: route('admin.dashboard'),
            },
            {
                label: $tChoice('decision.label', 2),
                url: route('admin.decisions.index'),
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
                    route-name="front.decisions.show"
                    route-key="decision"
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
                :label="$t('field.documents')"
                v-model:media="form.media"
                accepts="files"
                :limit="10"
            />

            <form-select-multiple
                name="categories"
                :label="$t('field.categories')"
                v-model="form.categories"
                :options="categories"
                option-value-key="id"
                option-label-key="title"
            />

            <form-select-multiple
                name="authors"
                :label="$t('field.authors')"
                v-model="form.authors"
                :options="authors"
                option-value-key="id"
                option-label-key="title"
            />

            <form-input
                :label="$t('field.number')"
                name="number"
                v-model="form.number"
            />

            <form-date-picker
                :label="$t('field.date')"
                name="date"
                v-model="form.date"
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
            authors: Array,
        },
    };
</script>
