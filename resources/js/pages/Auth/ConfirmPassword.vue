<template>
    <layout-guest>
        <div class="mb-4 text-sm text-gray-600">
            This is a secure area of the application. Please confirm your
            password before continuing.
        </div>

        <validation-errors class="mb-4" />

        <form @submit.prevent="submit">
            <div>
                <form-label for="password" value="Password" />
                <form-input
                    id="password"
                    type="password"
                    class="block w-full mt-1"
                    v-model="form.password"
                    required
                    autocomplete="current-password"
                    autofocus
                />
            </div>

            <div class="flex justify-end mt-4">
                <form-button
                    class="ml-4"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Confirm
                </form-button>
            </div>
        </form>
    </layout-guest>
</template>

<script>
    export default {
        data() {
            return {
                form: this.$inertia.form({
                    password: '',
                }),
            };
        },

        methods: {
            submit() {
                this.form.post(this.route('password.confirm'), {
                    onFinish: () => this.form.reset(),
                });
            },
        },
    };
</script>
