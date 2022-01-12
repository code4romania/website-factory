<template>
    <settings-section>
        <template #settings="{ form }">
            <div class="space-y-1">
                <localized-field
                    field="form-input"
                    :label="$t('field.title')"
                    name="title"
                    v-model="form.settings.site_title"
                    required
                />
            </div>

            <localized-field
                field="form-textarea"
                :label="$t('field.description')"
                name="description"
                required
                v-model="form.settings.site_description"
            />

            <form-file
                :label="$t('field.logo')"
                name="logo"
                v-model="form.settings.logo"
                :accept="[
                    'image/x-png',
                    'image/gif',
                    'image/jpeg',
                    'image/svg+xml',
                ]"
            />

            <form-color-picker
                :label="$t('field.color_primary')"
                v-model="form.settings.colors.primary"
            />
        </template>
    </settings-section>
</template>

