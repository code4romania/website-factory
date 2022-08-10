<template>
    <layout-guest :title="$t('auth.change_password')">
        <validation-errors class="mb-4" />

        <form @submit.prevent="submit" class="space-y-4">
            <form-input
                :label="$t('field.email')"
                type="email"
                v-model="form.email"
                required
                autofocus
                autocomplete="username"
                disabled
                readonly
            />

            <form-input
                :label="$t('field.password')"
                type="password"
                v-model="form.password"
                required
                autocomplete="new-password"
            />

            <form-input
                :label="$t('field.password_confirmation')"
                type="password"
                v-model="form.password_confirmation"
                required
                autocomplete="new-password"
            />

            <div class="flex items-center justify-end mt-4">
                <form-button
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                    :label="$t('auth.change_password')"
                />
            </div>
        </form>
    </layout-guest>
</template>

<script>
    import { useForm } from '@inertiajs/inertia-vue3';
    import { route } from '@/helpers';

    export default {
        props: {
            email: String,
            token: String,
        },
        setup(props) {
            const form = useForm({
                token: props.token,
                email: props.email,
                password: '',
                password_confirmation: '',
            });

            const submit = () => {
                form.post(route('auth.password.update'), {
                    onFinish: () => form.reset('password', 'password_confirmation'),
                });
            };

            return {
                form,
                submit,
            };
        },
    };
</script>
