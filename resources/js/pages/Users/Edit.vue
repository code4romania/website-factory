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

            <form-select
                :label="$t('field.role')"
                name="role"
                :options="
                    ['admin', 'editor', 'user'].map((role) => ({
                        label: $t(`user.role.${role}`),
                        value: role,
                    }))
                "
                v-model="form.role"
                required
            />

            <form-select
                :label="$t('field.locale')"
                name="locale"
                :options="['ro', 'en']"
                v-model="form.locale"
                required
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
