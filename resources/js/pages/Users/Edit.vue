<template>
    <form-container
        :resource="resource"
        :model="model"
        :fields="['name', 'email', 'role', 'locale']"
        :breadcrumbs="[
            {
                label: $t('app.dashboard'),
                url: route('admin.dashboard'),
            },
            {
                label: $tChoice('user.label', 2),
                url: route('admin.users.index'),
            },
        ]"
        hide-language-switcher
    >
        <template #panel="{ form }">
            <form-input
                type="text"
                :label="$t('field.name')"
                name="name"
                v-model="form.name"
                required
            />

            <form-input
                type="email"
                :label="$t('field.email')"
                name="email"
                v-model="form.email"
                required
            />

            <form-radio-group
                :label="$t('field.role')"
                name="role"
                :options="roles"
                default="editor"
                v-model="form.role"
                required
            />

            <form-radio-group
                :label="$t('field.locale')"
                name="locale"
                :options="localeOptions"
                :default="currentLocale"
                v-model="form.locale"
                required
            />
        </template>
    </form-container>
</template>

<script>
    import { computed } from 'vue';
    import { useLocale } from '@/helpers';
    import { trans } from 'laravel-vue-i18n';

    export default {
        props: {
            resource: Object,
            model: Object,
            userRoles: Array,
        },

        setup(props) {
            const { locales, currentLocale } = useLocale();

            const localeOptions = computed(() =>
                Object.entries(locales.value).map(([locale, config]) => ({
                    value: locale,
                    label: config.name,
                }))
            );

            const roles = computed(() =>
                props.userRoles.map((role) => ({
                    label: trans(`user.role.${role}`),
                    value: role,
                }))
            );

            return {
                currentLocale,
                localeOptions,
                roles,
            };
        },
    };
</script>
