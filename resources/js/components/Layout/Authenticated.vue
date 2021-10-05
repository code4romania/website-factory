<template>
    <inertia-head :title="title" />

    <div class="flex flex-col min-h-screen bg-gray-100">
        <header>
            <menu-navbar :main-menu="mainMenu" :admin-menu="adminMenu" :profile-menu="profileMenu" />

            <div v-if="$slots.subnav" class="py-2 bg-gray-200">
                <div class="container flex items-center py-3">
                    <slot name="subnav" />
                </div>
            </div>

            <div class="container items-center justify-between mt-12 lg:flex">
                <div class="flex-1 space-y-2">
                    <breadcrumbs :items="breadcrumbs" />

                    <h1 class="text-2xl font-bold text-gray-900 md:text-3xl md:truncate" v-text="title" />
                </div>

                <div v-if="$slots.actions" class="flex items-center justify-end mt-4 space-x-3 lg:mt-0">
                    <slot name="actions" />
                </div>
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
                <span class="block sm:inline" v-text="$page.props.app.version" />
            </div>
        </footer>

        <flash-toast />
    </div>
</template>

<script>
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
        },
        data() {
            return {
                mainMenu: [
                    {
                        href: this.route('admin.dashboard'),
                        label: this.$t('app.dashboard'),
                        route: 'admin.dashboard',
                    },
                    {
                        href: this.route('admin.pages.index'),
                        label: this.$tc('page.label', 2),
                        route: 'admin.pages.index',
                    },
                    // {
                    //     href: this.route('admin.categories.index'),
                    //     label: this.$tc('category.label', 2),
                    //     route: 'admin.categories.index',
                    // },
                    {
                        href: this.route('admin.forms.index'),
                        label: this.$tc('form.label', 2),
                        route: 'admin.forms.index',
                    },
                    {
                        href: this.route('admin.users.index'),
                        label: this.$tc('user.label', 2),
                        route: 'admin.users.index',
                    },
                ],
                adminMenu: [
                    {
                        href: '#',
                        label: this.$t('app.settings'),
                        route: 'admin.settings.index',
                    },
                ],
                profileMenu: [
                    {
                        href: '#',
                        label: this.$t('app.profile'),
                    },
                    {
                        href: this.route('auth.logout'),
                        label: this.$t('auth.logout'),
                        method: 'post',
                        route: 'auth.logout',
                    },
                ],
            };
        },
    };
</script>
