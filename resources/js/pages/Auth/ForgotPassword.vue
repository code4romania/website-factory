<template>
    <layout-guest>
        <div class="mb-4 text-sm text-gray-600">
            Forgot your password? No problem. Just let us know your email
            address and we will email you a password reset link that will allow
            you to choose a new one.
        </div>

        <div v-if="status" class="mb-4 text-sm font-medium text-green-600">
            {{ status }}
        </div>

        <validation-errors class="mb-4" />

        <form @submit.prevent="submit">
            <div>
                <form-label for="email" value="Email" />
                <form-input
                    id="email"
                    type="email"
                    class="block w-full mt-1"
                    v-model="form.email"
                    required
                    autofocus
                    autocomplete="username"
                />
            </div>

            <div class="flex items-center justify-end mt-4">
                <form-button
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Email Password Reset Link
                </form-button>
            </div>
        </form>
    </layout-guest>
</template>

<script>
    export default {
        props: {
            status: String,
        },

        data() {
            return {
                form: this.$inertia.form({
                    email: '',
                }),
            };
        },

        methods: {
            submit() {
                this.form.post(this.route('auth.password.email'));
            },
        },
    };
</script>
