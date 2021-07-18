<template>
    <div class="flex flex-col min-h-screen bg-gray-100">
        <header class="pb-32 bg-gray-800">
            <div class="container px-4 sm:px-6 lg:px-8">
                <menu-navbar :menu="menu" :profile="profile" />

                <div class="items-center justify-between w-full mt-16 lg:flex">
                    <h1 class="text-2xl font-bold text-white lg:text-3xl">
                        <slot name="title" />
                    </h1>

                    <div
                        v-if="$slots.actions"
                        class="flex items-center justify-end mt-4 space-x-3 lg:mt-0"
                    >
                        <slot name="actions" />
                    </div>
                </div>
            </div>
        </header>

        <main class="container flex-auto px-4 pb-8 -mt-24 sm:px-6 lg:px-8">
            <div
                class="grid items-start grid-cols-1 gap-4 lg:gap-8"
                :class="{
                    'lg:grid-cols-3': $slots.sidebar,
                }"
            >
                <div
                    class="p-6 overflow-hidden bg-white rounded-lg shadow"
                    :class="{
                        'lg:col-span-2': $slots.sidebar,
                    }"
                >
                    <slot />
                </div>

                <aside
                    v-if="$slots.sidebar"
                    class="p-6 overflow-hidden bg-white rounded-lg shadow"
                >
                    <slot name="sidebar" />
                </aside>
            </div>
        </main>

        <footer class="container px-4 sm:px-6 lg:px-8">
            <div
                class="flex justify-between py-8 text-sm text-center text-gray-500 border-t border-gray-200 sm:text-left"
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
            footer: Object,
        },
        data() {
            return {
                menu: [
                    {
                        href: this.route('admin.dashboard'),
                        label: this.$t('app.dashboard'),
                    },
                ],
                profile: [
                    {
                        href: '#',
                        label: this.$t('app.settings'),
                    },
                    {
                        href: this.route('logout'),
                        label: this.$t('auth.logout'),
                        method: 'post',
                    },
                ],
            };
        },
    };
</script>
