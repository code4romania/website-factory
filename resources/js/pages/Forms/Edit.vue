<template>
    <form-container
        :resource="resource"
        :model="model"
        :action="action"
        :fields="[
            'title',
            'slug',
            'description',
            'store_submissions',
            'send_submissions',
            'recipients',
            'blocks',
        ]"
        :field-types="{
            store_submissions: Boolean,
            send_submissions: Boolean,
        }"
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
                v-model="form.description"
            />

            <form-checkbox
                name="store_submissions"
                :label="$t('field.store_submissions')"
                v-model="form.store_submissions"
            />

            <form-checkbox
                name="send_submissions"
                :label="$t('field.send_submissions')"
                v-model="form.send_submissions"
            />

            <form-textarea
                v-if="form.send_submissions"
                :label="$t('field.recipients')"
                name="recipients"
                v-model="form.recipients"
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
</template>

<script>
    export default {
        props: {
            resource: Object,
            model: Object,
        },
    };
</script>
