<template>
    <inertia-head :title="title" />

    <div class="flex flex-col min-h-screen bg-gray-100">
        <header>
            <menu-navbar :menu="menu" :profile="profile" />

            <div
                style="display: none"
                class="container items-center justify-between mt-12 lg:flex"
            >
                <div class="flex-1 space-y-2">
                    <breadcrumbs :items="breadcrumbs" />

                    <h1
                        class="text-2xl font-bold text-gray-900  md:text-3xl md:truncate"
                        v-text="title"
                    />
                </div>

                <div
                    v-if="$slots.actions"
                    class="flex items-center justify-end mt-4 space-x-3 lg:mt-0"
                >
                    <slot name="actions" />
                </div>
            </div>
        </header>

        <main class="container flex flex-col flex-auto py-8">
            <slot />
        </main>

        <footer class="container">
            <div
                class="flex justify-between py-8 text-sm text-center text-gray-500 border-t border-gray-200  sm:text-left"
            >
                <span class="block sm:inline">Website Factory</span>
                <span
                    class="block sm:inline"
                    v-text="$page.props.footer.version"
                />
            </div>
        </footer>
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
                menu: [
                    {
                        href: this.route('admin.dashboard'),
                        label: this.$t('app.dashboard'),
                    },
                    {
                        href: this.route('admin.pages.index'),
                        label: this.$tc('page.label', 2),
                    },
                    {
                        href: this.route('admin.forms.index'),
                        label: this.$tc('form.label', 2),
                    },
                    {
                        href: this.route('admin.users.index'),
                        label: this.$tc('user.label', 2),
                    },
                ],
                profile: [
                    {
                        href: '#',
                        label: this.$t('app.settings'),
                    },
                    {
                        href: this.route('auth.logout'),
                        label: this.$t('auth.logout'),
                        method: 'post',
                    },
                ],
            };
        },
    };
</script>
