<template>
    <inertia-head :title="title" />

    <div class="flex flex-col min-h-screen bg-gray-100">
        <header>
            <menu-navbar
                :main-menu="mainMenu"
                :secondary-menu="secondaryMenu"
                :profile-menu="profileMenu"
            />

            <div v-if="$slots.subnav" class="bg-gray-200">
                <div
                    class="container flex items-center py-3 space-x-3 overflow-x-auto"
                >
                    <slot name="subnav" />
                </div>
            </div>

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
                    class="max-w-4xl mt-2 text-sm prose text-gray-500"
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
                <span class="block sm:inline">Website Factory</span>
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
        inject: ['bus'],
        data() {
            return {
                profileMenu: [
                    {
                        type: 'link',
                        href: this.route('auth.logout'),
                        label: this.$t('auth.logout'),
                        method: 'post',
                    },
                ],
            };
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

            return {
                mainMenu,
                secondaryMenu,
            };
        },
    };
</script>
