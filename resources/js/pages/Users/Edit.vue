<template>
    <layout :title="$t(`user.action.${action}`)">
        <form-container
            :resource="resource"
            :model="model"
            :action="action"
            :fields="['name', 'email', 'role', 'locale']"
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
    </layout>
</template>

<script>
    import { computed } from 'vue';

    export default {
        props: {
            resource: Object,
            model: Object,
        },
        setup(props) {
            const action = computed(() =>
                props.resource === undefined ? 'create' : 'edit'
            );

            return {
                action,
            };
        },
    };
</script>
