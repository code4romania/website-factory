<template>
    <layout :title="$t(`form.action.${action}`)">
        <form-container
            :resource="resource"
            :model="model"
            :action="action"
            :fields="['title', 'slug', 'description', 'blocks']"
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

                    <form-slug
                        :label="$t('field.slug')"
                        name="slug"
                        v-model="form.slug"
                        route-name="front.forms.show"
                        route-key="form"
                    />
                </div>

                <localized-field
                    field="form-editor"
                    name="description"
                    :label="$t('field.description')"
                    required
                    v-model="form.description"
                />
            </template>

            <template #content="{ form }">
                <block-list
                    v-model:blocks="form.blocks"
                    block-type="form-block"
                    :title="$t('form.blocks.title')"
                    :action="$t('form.blocks.action')"
                />
            </template>
        </form-container>
    </layout>
</template>

<script>
    import { computed } from 'vue';

    export default {
        props: {
            resource: Object,
            model: Object,
        },
        setup(props) {
            const action = computed(() =>
                props.resource === undefined ? 'create' : 'edit'
            );

            return {
                action,
            };
        },
    };
</script>
