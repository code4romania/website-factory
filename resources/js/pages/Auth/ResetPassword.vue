<template>
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

        <div class="mt-4">
            <form-label for="password" value="Password" />
            <form-input
                id="password"
                type="password"
                class="block w-full mt-1"
                v-model="form.password"
                required
                autocomplete="new-password"
            />
        </div>

        <div class="mt-4">
            <form-label for="password_confirmation" value="Confirm Password" />
            <form-input
                id="password_confirmation"
                type="password"
                class="block w-full mt-1"
                v-model="form.password_confirmation"
                required
                autocomplete="new-password"
            />
        </div>

        <div class="flex items-center justify-end mt-4">
            <form-button
                :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing"
            >
                Reset Password
            </form-button>
        </div>
    </form>
</template>

<script>
    export default {
        layout: 'LayoutGuest',

        props: {
            email: String,
            token: String,
        },

        data() {
            return {
                form: this.$inertia.form({
                    token: this.token,
                    email: this.email,
                    password: '',
                    password_confirmation: '',
                }),
            };
        },

        methods: {
            submit() {
                this.form.post(this.route('password.update'), {
                    onFinish: () =>
                        this.form.reset('password', 'password_confirmation'),
                });
            },
        },
    };
</script>
