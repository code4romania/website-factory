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
                />

                <form-select
                    :label="$t('field.default_locale')"
                    name="settings.default_locale"
                    v-model="form.settings.default_locale"
                    :options="localeOptions"
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

                <form-select
                    :label="$t('field.privacy_page')"
                    name="settings.privacy_page"
                    v-model="form.settings.privacy_page"
                    :options="data.pages.data"
                    option-value-key="id"
                    option-label-key="title"
                    required
                />

                <form-select
                    :label="$t('field.terms_page')"
                    name="settings.terms_page"
                    v-model="form.settings.terms_page"
                    :options="data.pages.data"
                    option-value-key="id"
                    option-label-key="title"
                    required
                />
            </panel>

            <panel title="Branding">
                <form-color-picker
                    v-if="hasFeature('theme')"
                    :label="$t('setting.site.colors.primary')"
                    name="settings.colors.primary"
                    v-model="form.settings.colors.primary"
                    disable-alpha
                />

                <form-file
                    :label="$t('setting.site.logo')"
                    name="settings.logo"
                    v-model="form.settings.logo"
                    :accept="['.png', '.gif', '.jpg', '.jpeg', '.svg']"
                    :help="$t('field_help.logo')"
                />

                <form-file
                    :label="$t('setting.site.favicon')"
                    name="settings.favicon"
                    v-model="form.settings.favicon"
                    :accept="['.png', '.gif', '.jpg', '.jpeg']"
                    :help="$t('field_help.favicon')"
                />
            </panel>

            <panel title="Custom HTML">
                <form-textarea
                    :label="$t('setting.site.html.header')"
                    name="settings.html.header"
                    v-model="form.settings.html.header"
                    rows="5"
                />

                <form-textarea
                    :label="$t('setting.site.html.footer')"
                    name="settings.html.footer"
                    v-model="form.settings.html.footer"
                    rows="5"
                />
            </panel>
        </template>
    </settings-section>
</template>

<script>
    import { useFeature, useLocale } from '@/helpers';

    export default {
        props: {
            data: {
                type: Object,
                default: () => ({}),
            },
        },
        setup(props) {
            const { hasFeature } = useFeature();

            const { locales, activeLocales } = useLocale();

            const localeOptions = Object.entries(locales.value)
                .filter(([locale]) => activeLocales.value.includes(locale))
                .map(([locale, config]) => ({
                    value: locale,
                    label: config.name,
                }));

            return {
                hasFeature,
                localeOptions,
            };
        },
    };
</script>
