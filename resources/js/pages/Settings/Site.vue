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
                    :accept="['.png', '.gif', '.jpg', '.jpeg', '.svg']"
                />
            </panel>

            <panel title="Global Notice">
                <form-checkbox
                    :label="$t('field.enabled')"
                    v-model="form.settings.notice.enabled"
                />

                <form-color-picker
                    :label="$t('setting.site.notice.color')"
                    name="settings.notice.color"
                    v-model="form.settings.notice.color"
                />

                <localized-field
                    field="form-editor"
                    :label="$t('setting.site.notice.text')"
                    name="settings.notice.text"
                    v-model="form.settings.notice.text"
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
