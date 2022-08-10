<template>
    <layout-guest :title="$t('auth.reset')">
        <div
            class="mb-4 text-sm text-gray-600"
            v-text="$t('auth.forgot_text')"
        />

        <div v-if="status" class="mb-4 text-sm font-medium text-green-600">
            {{ status }}
        </div>

        <validation-errors class="mb-4" />

        <form @submit.prevent="submit">
            <form-input
                :label="$t('field.email')"
                type="email"
                v-model="form.email"
                required
                autofocus
                autocomplete="username"
            />

            <div class="flex items-center justify-end mt-4">
                <form-button
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                    :label="$t('auth.reset')"
                />
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
