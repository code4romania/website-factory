<template>
    <div class="bg-gray-800">
        <div class="container lg:divide-gray-700 lg:divide-y">
            <div
                class="relative flex items-center justify-between h-16 gap-x-4 md:gap-x-8"
            >
                <div class="flex items-center px-2 shrink-0 lg:px-0">
                    <app-logo class="block h-10" light link />
                </div>

                <search class="flex-1" />

                <div
                    class="hidden shrink-0 lg:flex lg:space-x-4 lg:items-center"
                >
                    <dropdown
                        class="relative"
                        origin="top-right"
                        trigger-class="flex rounded-full focus:outline-none focus:ring-1 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white"
                    >
                        <template #trigger>
                            <img
                                class="w-8 h-8 rounded-full"
                                :src="$page.props.auth.user.avatar"
                                :alt="$page.props.auth.user.name"
                            />
                        </template>

                        <template #content>
                            <dropdown-item
                                v-for="(item, index) in profileMenu"
                                :key="index"
                                :method="item.method || 'get'"
                                :as="item.method === 'post' ? 'button' : 'a'"
                                :href="item.href"
                                v-text="item.label"
                            />
                        </template>
                    </dropdown>
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
                        <img
                            class="w-10 h-10 rounded-full shrink-0"
                            :src="$page.props.auth.user.avatar"
                            alt=""
                        />

                        <div class="ml-3 font-medium">
                            <div
                                class="text-white"
                                v-text="$page.props.auth.user.name"
                            />
                            <div
                                class="text-xs text-gray-300"
                                v-text="$page.props.auth.user.email"
                            />
                        </div>
                    </div>

                    <div class="space-y-1">
                        <menu-item
                            v-for="(item, index) in profileMenu"
                            :key="index"
                            :as="item.method === 'post' ? 'button' : 'a'"
                            v-bind="item"
                            class="block w-full text-sm"
                        >
                            {{ item.label }}
                        </menu-item>
                    </div>
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
            profileMenu: {
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
