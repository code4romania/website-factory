<template>
    <layout :title="title">
        <template #subnav>
            <menu-item
                v-for="section in sections"
                :key="section"
                :href="route('admin.settings.edit', { section })"
                class="text-sm"
                class-active="bg-gray-50 text-gray-900"
                class-inactive="text-gray-900 hover:bg-gray-100 hover:text-gray-900"
            >
                {{ $t(`setting.section.${section}`) }}
            </menu-item>
        </template>

        <form @submit.prevent="form.post(url)" class="grid gap-y-8">
            <div class="flex flex-col items-start gap-8 lg:flex-row-reverse">
                <div
                    class="relative flex flex-col w-full text-sm bg-white divide-y divide-gray-200 shadow lg:w-80"
                >
                    <div class="px-3 py-3">
                        <form-button
                            class="w-full"
                            type="submit"
                            :disabled="form.processing"
                            :label="$t('app.action.save')"
                        />
                    </div>
                </div>

                <div class="w-full space-y-8 lg:flex-1">
                    <slot name="fields" :form="form" />
                </div>
            </div>
        </form>
    </layout>
</template>

<script>
    import { computed } from 'vue';
    import { useForm, usePage } from '@inertiajs/inertia-vue3';
    import { route } from '@/helpers';
    import { trans, transChoice } from 'laravel-vue-i18n';

    export default {
        name: 'SettingsSection',
        setup(props) {
            const sections = computed(() => usePage().props.value.sections);
            const section = computed(() => usePage().props.value.section);

            const form = useForm({
                settings: usePage().props.value.settings,
            });

            const url = route('admin.settings.store', { section: section.value });

            const title = computed(() => {
                let prefix = transChoice('setting.label', 2),
                    sectionLabel = trans(`setting.section.${section.value}`);

                return `${prefix}: ${sectionLabel}`;
            });

            return {
                sections,
                section,
                form,
                url,
                title,
            };
        },
    };
</script>
