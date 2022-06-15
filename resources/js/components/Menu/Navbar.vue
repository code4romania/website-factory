<template>
    <div class="bg-gray-800">
        <div class="container lg:divide-gray-700 lg:divide-y">
            <div
                class="relative flex items-center justify-between h-16 gap-x-4"
            >
                <app-logo class="block h-10 text-gray-100 shrink-0" link />

                <search class="flex-1" />

                <div
                    class="hidden shrink-0 lg:flex lg:space-x-4 lg:items-center"
                >
                    <dropdown
                        class="relative"
                        origin="top-right"
                        trigger-class="flex p-1.5 text-white focus:outline-none hover:text-white hover:bg-gray-700 focus:ring-2 focus:ring-inset focus:ring-white"
                        content-class="bg-white"
                    >
                        <template #trigger>
                            <icon name="System/settings-line" class="w-6 h-6" />
                        </template>

                        <template #content>
                            <div class="divide-y divide-gray-100">
                                <div class="px-4 py-3 text-sm font-medium">
                                    <div v-text="$page.props.auth.name" />

                                    <div
                                        class="text-xs text-gray-400"
                                        v-text="$page.props.auth.email"
                                    />
                                </div>

                                <div class="py-1">
                                    <dropdown-item
                                        v-for="(item, index) in settingsMenu"
                                        :key="index"
                                        :method="item.method || 'get'"
                                        :as="
                                            item.method === 'post'
                                                ? 'button'
                                                : 'a'
                                        "
                                        :href="item.href"
                                        v-text="item.label"
                                    />
                                </div>

                                <div class="py-1">
                                    <dropdown-item
                                        method="post"
                                        as="button"
                                        :href="route('auth.logout')"
                                        v-text="$t('auth.logout')"
                                    />
                                </div>
                            </div>
                        </template>
                    </dropdown>
                </div>

                <div class="flex lg:hidden">
                    <!-- Mobile menu button -->
                    <button
                        type="button"
                        class="inline-flex items-center justify-center p-1.5 text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
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
                <div class="flex space-x-2">
                    <menu-item
                        v-for="(item, index) in mainMenu"
                        :key="index"
                        v-bind="item"
                        class="text-sm"
                    >
                        {{ item.label }}
                    </menu-item>
                </div>

                <div class="flex space-x-2">
                    <menu-item
                        type="button"
                        @click="bus.emit('media-library:open')"
                        class="text-sm"
                    >
                        {{ $t('media.library') }}
                    </menu-item>
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
                        v-bind="item"
                    >
                        {{ item.label }}
                    </menu-item>
                </div>

                <div class="pt-4 space-y-1">
                    <menu-item
                        type="button"
                        @click="bus.emit('media-library:open')"
                    >
                        {{ $t('media.library') }}
                    </menu-item>

                    <menu-item
                        v-for="(item, index) in secondaryMenu"
                        :key="index"
                        v-bind="item"
                    >
                        {{ item.label }}
                    </menu-item>
                </div>

                <div class="pt-4 space-y-3">
                    <div class="flex items-center px-3">
                        <div class="font-medium">
                            <div
                                class="text-white"
                                v-text="$page.props.auth.name"
                            />
                            <div
                                class="text-xs text-gray-300"
                                v-text="$page.props.auth.email"
                            />
                        </div>
                    </div>

                    <div class="space-y-1">
                        <menu-item
                            v-for="(item, index) in settingsMenu"
                            :key="index"
                            :as="item.method === 'post' ? 'button' : 'a'"
                            v-bind="item"
                            class="block w-full text-sm"
                            v-text="item.label"
                        />
                    </div>
                </div>

                <div class="py-2">
                    <menu-item
                        method="post"
                        as="button"
                        :href="route('auth.logout')"
                        class="block w-full text-sm"
                        v-text="$t('auth.logout')"
                    />
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { ref } from 'vue';

    export default {
        name: 'MenuNavbar',
        props: {
            mainMenu: {
                type: Array,
                default: () => [],
            },
            secondaryMenu: {
                type: Array,
                default: () => [],
            },
            settingsMenu: {
                type: Array,
                default: () => [],
            },
        },
        inject: ['bus'],
        setup(props) {
            const open = ref(false);

            return {
                open,
            };
        },
    };
</script>
