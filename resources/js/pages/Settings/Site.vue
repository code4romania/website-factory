<template>
    <settings-section>
        <template #settings="{ form }">
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
                required
                v-model="form.settings.description"
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

            <form-color-picker
                :label="$t('setting.site.colors.primary')"
                name="settings.colors.primary"
                v-model="form.settings.colors.primary"
            />
        </template>
    </settings-section>
</template>

