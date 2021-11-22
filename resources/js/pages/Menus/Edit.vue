<template>
    <layout
        :title="$t('menu.action.edit') + ': ' + $t(`menu.location.${location}`)"
    >
        <template #subnav>
            <menu-item
                v-for="location in locations"
                :key="location"
                :href="route('admin.menus.edit', { location })"
                class="text-sm"
                class-active="bg-gray-50 text-gray-900"
                class-inactive="text-gray-900 hover:bg-gray-100 hover:text-gray-900"
            >
                {{ $t(`menu.location.${location}`) }}
            </menu-item>
        </template>

        <template #actions>
            <button
                type="submit"
                form="menu-builder"
                :disabled="form.processing"
                class="relative inline-flex items-center justify-center flex-1 px-4 py-2 text-sm font-semibold tracking-wider text-white transition duration-150 ease-in-out bg-green-600 border border-transparent focus:outline-none focus:ring-2 focus:ring-offset-2 hover:bg-green-700 focus:ring-green-500 disabled:opacity-50 disabled:cursor-default"
                v-text="$t('app.action.save')"
            />
        </template>

        <form id="menu-builder" @submit.prevent="form.post(url)">
            <menu-builder-list
                prefix="items"
                :items="form.items"
                :max-depth="maxDepth"
            />
        </form>
    </layout>
</template>

<script>
    import { computed } from 'vue';
    import { route } from '@/helpers';
    import { useForm } from '@inertiajs/inertia-vue3';
    import Draggable from 'vuedraggable';

    export default {
        components: {
            Draggable,
        },
        props: {
            collection: Object,
            location: String,
            locations: {
                type: Array,
                default: () => ['header', 'footer'],
            },
        },
        setup(props) {
            const form = useForm(`edit.menu.${location}`, {
                items: props.collection.data,
            });

            const url = route('admin.menus.update', { location: props.location });

            const maxDepth = computed(() => (props.location === 'header' ? 2 : 1));

            return {
                form,
                url,
                maxDepth,
            };
        },
    };
</script>
