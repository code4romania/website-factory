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
                    v-if="hasFeature('theme')"
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
        </template>
    </settings-section>
</template>

<script>
    import { useFeature } from '@/helpers';

    export default {
        props: {
            data: {
                type: Object,
                default: () => ({}),
            },
        },
        setup(props) {
            const { hasFeature } = useFeature();

            return { hasFeature };
        },
    };
</script>
