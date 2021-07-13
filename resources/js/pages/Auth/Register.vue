<template>
    <validation-errors class="mb-4" />

    <form @submit.prevent="submit">
        <div>
            <form-label for="name" value="Name" />
            <form-input
                id="name"
                type="text"
                class="block w-full mt-1"
                v-model="form.name"
                required
                autofocus
                autocomplete="name"
            />
        </div>

        <div class="mt-4">
            <form-label for="email" value="Email" />
            <form-input
                id="email"
                type="email"
                class="block w-full mt-1"
                v-model="form.email"
                required
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
            <inertia-link
                :href="route('login')"
                class="text-sm text-gray-600 underline hover:text-gray-900"
            >
                Already registered?
            </inertia-link>

            <form-button
                class="ml-4"
                :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing"
            >
                Register
            </form-button>
        </div>
    </form>
</template>

<script>
    export default {
        layout: 'LayoutGuest',

        data() {
            return {
                form: this.$inertia.form({
                    name: '',
                    email: '',
                    password: '',
                    password_confirmation: '',
                    terms: false,
                }),
            };
        },

        methods: {
            submit() {
                this.form.post(this.route('register'), {
                    onFinish: () =>
                        this.form.reset('password', 'password_confirmation'),
                });
            },
        },
    };
</script>
