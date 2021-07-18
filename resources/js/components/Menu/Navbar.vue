<template>
    <div
        class="border-b border-gray-700 lg:border-b-0 lg:divide-y lg:divide-gray-700"
    >
        <div class="relative flex items-center justify-between h-16">
            <div class="flex items-center px-2 lg:px-0">
                <div class="flex-shrink-0">
                    <app-logo class="block w-10 h-10" light link />
                </div>
            </div>

            <menu-search class="hidde" />

            <div class="flex lg:hidden">
                <!-- Mobile menu button -->
                <button
                    type="button"
                    class="inline-flex items-center justify-center p-2 text-gray-400 rounded-md hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
                    aria-controls="mobile-menu"
                    @click="open = !open"
                    aria-expanded="false"
                    x-bind:aria-expanded="open.toString()"
                >
                    <span class="sr-only">Open main menu</span>

                    <icon
                        v-show="!open"
                        name="System/menu-line"
                        class="block w-6 h-6"
                    />
                    <icon
                        v-show="open"
                        name="System/close-line"
                        class="block w-6 h-6"
                    />
                </button>
            </div>

            <div class="hidden lgd:block lg:ml-4">
                <!-- Settings Dropdown -->
                <div class="relative ml-3">
                    <dropdown align="right" width="48">
                        <template #trigger>
                            <button
                                class="flex items-center px-3 py-2 text-sm font-medium text-gray-300 transition duration-150 ease-in-out rounded-md hover:bg-gray-700 hover:text-white"
                                type="button"
                            >
                                <span v-text="$page.props.auth.user.name" />

                                <icon
                                    name="System/arrow-down-s-line"
                                    class="ml-2 -mr-0.5 h-4 w-4"
                                />
                            </button>
                        </template>

                        <template #content>
                            <dropdown-link
                                v-for="(item, index) in profile"
                                :key="index"
                                :method="item.method || 'get'"
                                :as="item.method === 'post' ? 'button' : 'a'"
                                :href="item.href"
                                v-text="item.label"
                            />
                        </template>
                    </dropdown>
                </div>
            </div>
        </div>

        <div class="hidden lg:flex lg:justify-between lg:py-2 lg:space-x-4">
            <div class="space-x-8">
                <menu-item
                    v-for="(item, index) in menu"
                    :key="index"
                    :href="item.href"
                    :label="item.label"
                    class="text-sm"
                />
            </div>

            <!-- Settings Dropdown -->
            <div class="relative ml-3">
                <dropdown align="right" width="48">
                    <template #trigger>
                        <button
                            class="flex items-center px-3 py-2 text-sm font-medium text-gray-300 transition duration-150 ease-in-out rounded-md hover:bg-gray-700 hover:text-white"
                            type="button"
                        >
                            <span v-text="$page.props.auth.user.name" />

                            <icon
                                name="System/arrow-down-s-line"
                                class="ml-2 -mr-0.5 h-4 w-4"
                            />
                        </button>
                    </template>

                    <template #content>
                        <dropdown-link
                            v-for="(item, index) in profile"
                            :key="index"
                            :method="item.method || 'get'"
                            :as="item.method === 'post' ? 'button' : 'a'"
                            :href="item.href"
                            v-text="item.label"
                        />
                    </template>
                </dropdown>
            </div>
        </div>

        <div
            class="border-t border-gray-700 lg:hidden"
            id="mobile-menu"
            v-show="open"
        >
            <div class="px-2 pt-2 pb-3 space-y-1">
                <menu-item
                    v-for="(item, index) in menu"
                    :key="index"
                    :href="item.href"
                    :label="item.label"
                    class="text-base"
                />
            </div>

            <div class="pt-4 pb-3 space-y-3 border-t border-gray-700">
                <div class="px-5">
                    <div
                        class="text-base font-medium text-white"
                        v-text="$page.props.auth.user.name"
                    />
                    <div
                        class="text-sm font-medium text-gray-300"
                        v-text="$page.props.auth.user.email"
                    />
                </div>

                <div class="px-2 space-y-1">
                    <menu-item
                        v-for="(item, index) in profile"
                        :key="index"
                        :method="item.method || 'get'"
                        :as="item.method === 'post' ? 'button' : 'a'"
                        class="block w-full text-sm"
                        :href="item.href"
                        :label="item.label"
                    />
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'MenuNavbar',
        props: {
            menu: {
                type: Array,
                default: () => [],
            },
            profile: {
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
