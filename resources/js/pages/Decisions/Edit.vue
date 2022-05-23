<template>
    <form-container
        :resource="resource"
        :model="model"
        :action="action"
        :fields="[
            'title',
            'slug',
            'description',
            'layout',
            'blocks',
            'media',
            'published_at',
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
                    route-name="front.decisions.show"
                    route-key="decision"
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
