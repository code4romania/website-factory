<template>
    <div>
        <form-button type="button" @click="confirmAction = true" color="blue">
            <div class="flex items-center gap-2">
                <icon
                    name="System/refresh-line"
                    class="w-4 h-4 ltr:-ml-1 rtl:-mr-1"
                />

                <span v-text="$t('app.action.restore')" />
            </div>
        </form-button>

        <confirmation-modal
            v-if="confirmAction"
            @close="confirmAction = false"
            @submit="submit"
            color="blue"
        >
            <template #title>{{ $t('app.action.restore') }}</template>

            <template #content>
                {{ $t('app.action.restoreConfirm') }}
            </template>

            <template #footer>
                <form-button
                    type="button"
                    @click.prevent="confirmAction = null"
                    :label="$t('app.action.cancel')"
                    :disabled="form.processing"
                    color="white"
                />

                <form-button
                    type="submit"
                    :label="$t('app.action.restore')"
                    :disabled="form.processing"
                    color="blue"
                />
            </template>
        </confirmation-modal>
    </div>
</template>

<script>
    import { ref } from 'vue';
    import { useForm } from '@inertiajs/vue3';
    import { route } from '@/helpers';

    export default {
        name: 'LanguageRestore',
        setup() {
            const form = useForm({});

            const confirmAction = ref(false);

            const submit = () => {
                return form.post(route('admin.languages.restore'), {
                    onSuccess: () => (confirmAction.value = false),
                });
            };

            return {
                form,
                confirmAction,

                submit,
            };
        },
    };
</script>
