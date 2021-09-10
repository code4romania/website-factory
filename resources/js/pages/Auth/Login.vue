<template>
    <layout-guest>
        <validation-errors class="mb-4" />

        <div v-if="status" class="mb-4 text-sm font-medium text-green-600">
            {{ status }}
        </div>

        <form @submit.prevent="submit" class="space-y-4">
            <form-input
                label="Email"
                id="email"
                type="email"
                class="block w-full mt-1"
                v-model="form.email"
                required
                autofocus
                autocomplete="username"
            />

            <form-input
                label="Password"
                id="password"
                type="password"
                class="block w-full mt-1"
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
    export default {
        props: {
            canResetPassword: Boolean,
            status: String,
        },

        data() {
            return {
                form: this.$inertia.form({
                    email: '',
                    password: '',
                    remember: false,
                }),
            };
        },

        methods: {
            submit() {
                this.form.post(this.route('auth.login'), {
                    onFinish: () => this.form.reset('password'),
                });
            },
        },
    };
</script>
