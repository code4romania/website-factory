<template>
    <layout :title="$t(pageTitle)">
        <form @submit.prevent="form.submit(method, url)" class="grid gap-y-8">
            <panel-model action="save" :form="form">
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
            </panel-model>
        </form>
    </layout>
</template>

<script>
    import { computed } from 'vue';
    import { useForm, route } from '@/helpers';

    export default {
        props: {
            user: Object,
            model: Object,
        },
        setup(props) {
            const action = props.user === undefined ? 'create' : 'edit';

            const form = useForm(`${action}.user`, props.user, [
                'name',
                'email',
                'role',
                'locale',
            ]);

            const method = computed(() => (action === 'edit' ? 'put' : 'post'));
            const url = computed(() =>
                action === 'edit'
                    ? route('admin.users.update', props.user)
                    : route('admin.users.store')
            );

            const pageTitle = computed(() => `user.action.${action}`);

            return {
                form,
                method,
                url,
                pageTitle,
            };
        },
    };
</script>
