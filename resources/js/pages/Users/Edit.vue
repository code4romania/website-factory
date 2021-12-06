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

                <form-input
                    type="text"
                    :label="$t('field.role')"
                    name="role"
                    v-model="form.role"
                    required
                />

                <form-input
                    type="text"
                    :label="$t('field.locale')"
                    name="locale"
                    v-model="form.locale"
                    required
                />
            </template>
        </form-container>
    </layout>
</template>

<script>
    export default {
        props: {
            resource: Object,
            model: Object,
        },
        setup(props) {
            const action = props.resource === undefined ? 'create' : 'edit';

            return {
                action,
            };
        },
    };
</script>
