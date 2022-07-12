<template>
    <settings-section>
        <template #fields="{ form }">
            <panel :title="$t('setting.section.site-notice')">
                <form-checkbox
                    :label="$t('field.enabled')"
                    v-model="form.settings.enabled"
                />

                <form-color-picker
                    :label="$t('setting.site.notice.color')"
                    name="settings.color"
                    v-model="form.settings.color"
                />

                <localized-field
                    field="form-editor"
                    :label="$t('setting.site.notice.text')"
                    name="settings.text"
                    v-model="form.settings.text"
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
