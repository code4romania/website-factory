<template>
    <layout :title="$t(`form.action.${action}`)">
        <form-container
            :resource="resource"
            :model="model"
            :action="action"
            :fields="['title', 'blocks', 'published_at']"
        >
            <template #panel="{ form }">
                <localized-field
                    field="form-input"
                    :label="$t('field.title')"
                    name="title"
                    v-model="form.title"
                    required
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
    export default {
        props: {
            resource: Object,
            model: Object,
        },
        setup(props) {
            const action = props.resource === undefined ? 'create' : 'edit';

            return {
                action,
            };
        },
    };
</script>
