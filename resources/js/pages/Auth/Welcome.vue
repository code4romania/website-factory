<template>
    <layout-guest>
        <validation-errors class="mb-4" />

        <form @submit.prevent="submit" class="space-y-4">
            <form-input
                :label="$t('field.email')"
                type="email"
                class="block w-full"
                :modelValue="email"
                disabled
                readonly
            />

            <form-input
                :label="$t('field.password')"
                type="password"
                class="block w-full"
                v-model="form.password"
                required
                autocomplete="new-password"
            />

            <form-input
                :label="$t('field.password_confirmation')"
                type="password"
                class="block w-full"
                v-model="form.password_confirmation"
                required
                autocomplete="new-password"
            />

            <div class="flex items-center justify-end mt-4">
                <form-button
                    class="ml-4"
                    :disabled="form.processing"
                    :label="$t('auth.welcome.submit')"
                />
            </div>
        </form>
    </layout-guest>
</template>

<script>
    import { useForm } from '@inertiajs/vue3';

    export default {
        props: {
            email: String,
        },

        setup(props) {
            const form = useForm({
                password: null,
                password_confirmation: null,
            });

            const submit = () => {
                form.post(window.location.href);
            };

            return {
                form,
                submit,
            };
        },
    };
</script>
