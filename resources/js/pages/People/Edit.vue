<template>
    <form-container
        :resource="resource"
        :model="model"
        :action="action"
        :fields="[
            'name',
            'slug',
            'title',
            'description',
            'social',
            'blocks',
            'media',
        ]"
        :field-types="{
            social: Object,
        }"
        :breadcrumbs="[
            {
                label: $t('app.dashboard'),
                url: route('admin.dashboard'),
            },
            {
                label: $tChoice('person.label', 2),
                url: route('admin.people.index'),
            },
        ]"
    >
        <template #panel="{ form }">
            <div class="space-y-1">
                <form-input
                    :label="$t('field.name')"
                    name="name"
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
                name="title"
                :label="$t('field.job_title')"
                v-model="form.title"
            />

            <localized-field
                field="form-textarea"
                name="description"
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

        <template #extra="{ form }">
            <panel title="Social Profiles">
                <form-input
                    v-for="(platform, id) in platforms"
                    :key="id"
                    :label="platform.label"
                    name="social"
                    v-model="form.social[id]"
                    :prefix="platform.prefix"
                />
            </panel>
        </template>

        <template #content="{ form }">
            <block-list v-model:blocks="form.blocks" />
        </template>
    </form-container>
</template>

<script>
    export default {
        props: {
            platforms: Array,
            resource: Object,
            model: Object,
        },
    };
</script>
