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
        inject: ['bus'],
        data() {
            return {
                mainMenu: [
                    {
                        type: 'link',
                        href: this.route('admin.dashboard'),
                        label: this.$t('app.dashboard'),
                    },
                    {
                        type: 'link',
                        href: this.route('admin.pages.index'),
                        label: this.$t('page.label', 2),
                    },
                    {
                        type: 'link',
                        href: this.route('admin.posts.index'),
                        label: this.$t('post.label', 2),
                    },
                    {
                        type: 'link',
                        href: this.route('admin.decisions.index'),
                        label: this.$t('decision.label', 2),
                    },
                    {
                        type: 'link',
                        href: this.route('admin.forms.index'),
                        label: this.$t('form.label', 2),
                    },
                    {
                        type: 'link',
                        href: this.route('admin.people.index'),
                        label: this.$t('person.label', 2),
                    },
                ],
                secondaryMenu: [
                    {
                        type: 'button',
                        label: this.$t('media.library'),
                        onClick: () => this.bus.emit('media-library:open'),
                    },
                    {
                        type: 'link',
                        href: this.route('admin.users.index'),
                        label: this.$t('user.label', 2),
                    },
                    {
                        type: 'link',
                        href: '#',
                        label: this.$t('app.settings'),
                    },
                ],
                profileMenu: [
                    {
                        type: 'link',
                        href: '#',
                        label: this.$t('app.profile'),
                    },
                    {
                        type: 'link',
                        href: this.route('auth.logout'),
                        label: this.$t('auth.logout'),
                        method: 'post',
                    },
                ],
            };
        },
    };
</script>
