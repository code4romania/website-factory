<template>
    <settings-section>
        <template #fields="{ form }">
            <panel title="General">
                <localized-field
                    field="form-input"
                    :label="$t('setting.site.title')"
                    name="settings.title"
                    v-model="form.settings.title"
                    required
                />

                <localized-field
                    field="form-textarea"
                    :label="$t('setting.site.description')"
                    name="settings.description"
                    v-model="form.settings.description"
                    required
                />

                <form-select
                    :label="$t('field.front_page')"
                    name="settings.front_page"
                    v-model="form.settings.front_page"
                    :options="data.pages.data"
                    option-value-key="id"
                    option-label-key="title"
                    required
                />
            </panel>

            <panel title="Branding">
                <form-color-picker
                    :label="$t('setting.site.colors.primary')"
                    name="settings.colors.primary"
                    v-model="form.settings.colors.primary"
                />

                <form-file
                    :label="$t('setting.site.logo')"
                    name="settings.logo"
                    v-model="form.settings.logo"
                    :accept="[
                        'image/x-png',
                        'image/gif',
                        'image/jpeg',
                        'image/svg+xml',
                    ]"
                />
            </panel>

            <panel title="Social Media">
                <form-input
                    v-for="(platform, id) in data.platforms"
                    :key="id"
                    :label="platform.label"
                    name="settings.social"
                    v-model="form.settings.social[id]"
                    :prefix="platform.prefix"
                />
            </panel>
        </template>
    </settings-section>
</template>

<script>
    export default {
        props: {
            data: {
                type: Object,
                default: () => ({}),
            },
        },
    };
</script>
