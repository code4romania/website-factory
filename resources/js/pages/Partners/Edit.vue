<template>
    <form-container
        :resource="resource"
        :model="model"
        :fields="['name', 'url', 'position', 'media']"
        :breadcrumbs="[
            {
                label: $t('app.dashboard'),
                url: route('admin.dashboard'),
            },
            {
                label: $tChoice('partner.label', 2),
                url: route('admin.partners.index'),
            },
        ]"
        hide-language-switcher
    >
        <template #panel="{ form }">
            <form-input
                :label="$t('field.name')"
                name="name"
                v-model="form.name"
                required
            />

            <form-input
                type="url"
                :label="$t('field.url')"
                name="url"
                v-model="form.url"
            />

            <form-input
                type="number"
                :label="$t('field.position')"
                name="position"
                v-model="form.position"
            />

            <form-media
                :label="$t('field.logo')"
                v-model:media="form.media"
                accepts="images"
                :limit="1"
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
