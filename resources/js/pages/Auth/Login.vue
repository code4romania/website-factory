<template>
    <layout-guest :title="$t('auth.login')">
        <validation-errors class="mb-4" />

        <div v-if="status" class="mb-4 text-sm font-medium text-green-600">
            {{ status }}
        </div>

        <form @submit.prevent="submit" class="space-y-4">
            <form-input
                :label="$t('field.email')"
                type="email"
                v-model="form.email"
                required
                autofocus
                autocomplete="username"
            />

            <form-input
                :label="$t('field.password')"
                type="password"
                v-model="form.password"
                required
                autocomplete="current-password"
            />

            <form-checkbox
                name="remember"
                :label="$t('auth.remember')"
                v-model="form.remember"
            />

            <div class="flex items-center justify-end mt-4">
                <inertia-link
                    v-if="canResetPassword"
                    :href="route('auth.password.request')"
                    class="text-sm text-gray-600 underline hover:text-gray-900"
                    v-text="$t('auth.forgot')"
                />

                <form-button
                    class="ml-4"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                    :label="$t('auth.login')"
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
            canResetPassword: Boolean,
            status: String,
        },
        setup(props) {
            const form = useForm({
                email: '',
                password: '',
                remember: false,
            });

            const submit = () => {
                form.post(route('auth.login'), {
                    onFinish: () => form.reset('password'),
                });
            };

            return {
                form,
                submit,
            };
        },
    };
</script>
