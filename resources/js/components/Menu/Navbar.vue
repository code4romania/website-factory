<template>
    <div class="bg-gray-800">
        <div class="container lg:divide-gray-700 lg:divide-y">
            <div class="relative flex items-center justify-between h-16">
                <div class="flex items-center px-2 lg:px-0">
                    <div class="flex-shrink-0">
                        <app-logo class="block w-10 h-10" light link />
                    </div>
                </div>

                <div class="hidden lg:block lg:ml-4">
                    <!-- Settings Dropdown -->
                    <div class="relative ml-3">
                        <dropdown
                            origin="top-right"
                            trigger-class="flex items-center px-3 py-2 text-sm font-medium text-gray-300 transition duration-150 ease-in-out hover:text-white hover:bg-gray-700"
                            with-arrow
                        >
                            <template #trigger>
                                <span v-text="$page.props.auth.user.name" />
                            </template>

                            <template #content>
                                <dropdown-item
                                    v-for="(item, index) in profileMenu"
                                    :key="index"
                                    :method="item.method || 'get'"
                                    :as="
                                        item.method === 'post' ? 'button' : 'a'
                                    "
                                    :href="item.href"
                                    v-text="item.label"
                                />
                            </template>
                        </dropdown>
                    </div>
                </div>

                <div class="flex lg:hidden">
                    <!-- Mobile menu button -->
                    <button
                        type="button"
                        class="inline-flex items-center justify-center p-2 text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
                        aria-controls="mobile-menu"
                        @click="open = !open"
                        aria-expanded="false"
                        x-bind:aria-expanded="open.toString()"
                    >
                        <span class="sr-only">Open main menu</span>

                        <icon
                            v-if="!open"
                            name="System/menu-line"
                            class="block w-6 h-6"
                        />
                        <icon
                            v-else
                            name="System/close-line"
                            class="block w-6 h-6"
                        />
                    </button>
                </div>
            </div>

            <div class="hidden lg:flex lg:py-3 lg:space-x-4 lg:justify-between">
                <div class="flex space-x-4">
                    <menu-item
                        v-for="(item, index) in mainMenu"
                        :key="index"
                        :href="item.href"
                        :route-name="item.route"
                        :label="item.label"
                        class="text-sm"
                    />
                </div>

                <div class="flex space-x-4">
                    <menu-item
                        v-for="(item, index) in adminMenu"
                        :key="index"
                        :href="item.href"
                        :route-name="item.route"
                        :label="item.label"
                        class="text-sm"
                    />
                </div>
            </div>

            <div
                class="p-2 space-y-3 border-t border-gray-700 divide-y divide-gray-700 lg:hidden"
                id="mobile-menu"
                v-show="open"
            >
                <div class="space-y-1">
                    <menu-item
                        v-for="(item, index) in mainMenu"
                        :key="index"
                        :href="item.href"
                        :route-name="item.route"
                        :label="item.label"
                        class="text-base"
                    />
                </div>

                <div v-if="adminMenu.length" class="pt-4 space-y-1">
                    <menu-item
                        v-for="(item, index) in adminMenu"
                        :key="index"
                        :href="item.href"
                        :route-name="item.route"
                        :label="item.label"
                        class="text-base"
                    />
                </div>

                <div class="pt-4 space-y-3">
                    <div class="px-3">
                        <div
                            class="text-base font-medium text-white"
                            v-text="$page.props.auth.user.name"
                        />
                        <div
                            class="text-sm font-medium text-gray-300"
                            v-text="$page.props.auth.user.email"
                        />
                    </div>

                    <div class="space-y-1">
                        <menu-item
                            v-for="(item, index) in profileMenu"
                            :key="index"
                            :method="item.method || 'get'"
                            :as="item.method === 'post' ? 'button' : 'a'"
                            class="block w-full text-sm"
                            :href="item.href"
                            :route-name="item.route"
                            :label="item.label"
                        />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'MenuNavbar',
        props: {
            mainMenu: {
                type: Array,
                default: () => [],
            },
            adminMenu: {
                type: Array,
                default: () => [],
            },
            profileMenu: {
                type: Array,
                default: () => [],
            },
        },
        data() {
            return {
                open: false,
            };
        },
    };
</script>
