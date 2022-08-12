<template>
    <inertia-head :title="title" />

    <div
        class="flex flex-col min-h-screen transition-opacity duration-200 bg-gray-100"
        :class="{ 'opacity-0': !isLoaded() }"
    >
        <header>
            <menu-navbar
                :main-menu="mainMenu"
                :secondary-menu="secondaryMenu"
                :settings-menu="settingsMenu"
            />

            <div v-if="$slots.subnav" class="bg-gray-200">
                <div
                    class="container flex items-center py-3 overflow-x-auto sm:space-x-2"
                >
                    <slot name="subnav" />
                </div>
            </div>

            <help-shortcuts v-if="!route().current('admin.help.*')" />

            <div class="container items-center justify-between mt-12 space-y-2">
                <breadcrumbs :items="breadcrumbs" />

                <div class="flex flex-col gap-4 md:flex-row">
                    <h1
                        class="flex-1 text-2xl font-bold text-gray-900 md:text-3xl md:truncate"
                        v-text="title"
                    />

                    <div
                        v-if="$slots.actions"
                        class="flex items-center space-x-3 md:justify-end"
                    >
                        <slot name="actions" />
                    </div>
                </div>

                <div
                    v-if="description"
                    class="mt-2 prose text-gray-500 max-w-prose"
                    v-html="description"
                />
            </div>
        </header>

        <main class="container flex flex-col flex-auto py-8">
            <slot />
        </main>

        <footer class="container">
            <div
                class="flex justify-between py-8 text-sm text-center text-gray-500 border-t border-gray-200 sm:text-left"
            >
                <span class="block sm:inline">
                    Website Factory: {{ $page.props.app.edition }}</span
                >
                <span
                    class="block sm:inline"
                    v-text="$page.props.app.version"
                />
            </div>
        </footer>

        <flash-toast />

        <media-library />
    </div>
</template>

<script>
    import { computed } from 'vue';
    import { usePage } from '@inertiajs/inertia-vue3';
    import { route } from '@/helpers';
    import { isLoaded } from 'laravel-vue-i18n';

    export default {
        name: 'Layout',
        props: {
            breadcrumbs: {
                type: Array,
                default: () => [],
            },
            title: {
                type: String,
                default: null,
            },
            description: {
                type: String,
                default: null,
            },
        },
        setup() {
            const buildMenu = (items) =>
                items.map((item) => {
                    if (item.hasOwnProperty('route')) {
                        item.href = route(item.route);
                    }

                    return item;
                });

            const mainMenu = computed(() =>
                buildMenu(usePage().props.value.navigation.primary)
            );

            const secondaryMenu = computed(() =>
                buildMenu(usePage().props.value.navigation.secondary)
            );

            const settingsMenu = computed(() =>
                buildMenu(usePage().props.value.navigation.settings)
            );

            return {
                mainMenu,
                secondaryMenu,
                settingsMenu,

                isLoaded,
            };
        },
    };
</script>
