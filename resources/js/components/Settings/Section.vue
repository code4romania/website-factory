<template>
    <layout
        :title="
            $t('setting.label', 2) + ': ' + $t(`setting.section.${section}`)
        "
    >
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
            <panel-model action="save" :form="form" no-publisher>
                <slot name="settings" :form="form" />
            </panel-model>
        </form>
    </layout>
</template>

<script>
    import { computed } from 'vue';
    import { useForm, usePage } from '@inertiajs/inertia-vue3';
    import { route } from '@/helpers';

    export default {
        name: 'SettingsSection',
        setup(props) {
            const sections = computed(() => usePage().props.value.sections);
            const section = computed(() => usePage().props.value.section);

            const form = useForm({
                settings: usePage().props.value.settings,
            });

            const url = route('admin.settings.store', { section: section.value });

            return {
                sections,
                section,
                form,
                url,
            };
        },
    };
</script>
