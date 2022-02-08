<template>
    <div class="flex flex-1 md:relative">
        <form class="w-full" @submit.prevent="search" v-click-away="close">
            <label class="relative block text-white focus-within:text-gray-600">
                <span class="sr-only" v-text="$t('app.search.placeholder')" />

                <icon
                    name="System/search-line"
                    class="absolute inset-y-0 flex items-center w-5 h-full pointer-events-none left-3"
                />

                <input
                    type="search"
                    name="search"
                    ref="input"
                    class="block w-full py-2 pl-10 pr-3 text-white placeholder-gray-400 bg-gray-700 border-0 rounded-md focus:text-gray-900 focus:bg-white focus:outline-none focus:placeholder-gray-500 focus:ring-0 sm:text-sm"
                    :placeholder="$t('app.search.placeholder')"
                    autocomplete="off"
                    v-model="query"
                    @keydown.esc.stop="close"
                    @focus="open"
                />
            </label>
        </form>

        <transition
            enter-active-class="transition duration-100 ease-out"
            enter-class="transform scale-95 opacity-0"
            enter-to-class="transform scale-100 opacity-100"
            leave-active-class="transition ease-in duration-50"
            leave-class="transform scale-100 opacity-100"
            leave-to-class="transform scale-95 opacity-0"
        >
            <div
                v-if="searching || loading || hasResults"
                class="absolute z-50 w-full mt-4 overflow-x-hidden overflow-y-auto text-sm text-gray-500 origin-top-left bg-white rounded shadow-lg inset-x-2 md:inset-x-0 top-full max-h-96"
                ref="container"
            >
                <div
                    v-if="loading"
                    class="flex items-center justify-center px-4 py-2"
                >
                    <icon
                        name="System/loader-5-line"
                        class="w-5 h-5 animate-spin"
                    />
                </div>

                <ol v-else-if="hasResults" class="divide-y divide-gray-200">
                    <li
                        v-for="(item, index) in results"
                        :key="`result-${index}`"
                        :ref="index === highlightedItem ? 'selected' : null"
                    >
                        <inertia-link
                            :href="item.url_admin"
                            class="items-center block w-full px-4 py-2 text-sm hover:bg-gray-50"
                            :class="{
                                'bg-gray-50': index === highlightedItem,
                            }"
                        >
                            <p
                                class="font-semibold text-blue-600 truncate"
                                v-text="item.title"
                            />

                            <p class="flex items-center gap-1">
                                <span
                                    v-text="
                                        $t('app.time.edited', {
                                            ago: item.updated_at,
                                        })
                                    "
                                />

                                <span class=""> &ndash; </span>

                                <span
                                    v-text="$tChoice(`${item.type}.label`, 1)"
                                />
                            </p>
                        </inertia-link>
                    </li>
                </ol>

                <div
                    v-else
                    class="px-4 py-2 text-center"
                    v-text="$t('app.search.empty')"
                />
            </div>
        </transition>
    </div>
</template>

<script>
    import axios from 'axios';
    import debounce from 'lodash/debounce';
    import { route } from '@/helpers';
    import { computed, ref, watch } from 'vue';

    export default {
        name: 'Search',
        setup() {
            const input = ref(null);
            const query = ref(null);
            const loading = ref(false);
            const searching = ref(false);
            const results = ref([]);
            const highlightedItem = ref(null);

            const hasResults = computed(() => {
                if (!results.value.length) {
                    return false;
                }

                return true;
            });

            const search = debounce(() => {
                if (query.value.length < 3) {
                    return;
                }

                highlightedItem.value = null;
                loading.value = true;
                searching.value = true;

                axios
                    .get(route('admin.search', { query: query.value }))
                    .then((response) => {
                        results.value = response.data;
                        loading.value = false;
                    })
                    .catch((error) => {
                        loading.value = false;
                        throw error;
                    });
            }, 250);

            watch(query, search);

            const open = () => {
                query.value = '';
                input.value.focus();
            };

            const close = () => {
                input.value.blur();

                query.value = '';
                loading.value = false;
                searching.value = false;
                results.value = [];
            };

            return {
                input,
                query,
                loading,
                searching,
                results,
                highlightedItem,
                //
                hasResults,
                //
                search,
                open,
                close,
            };
        },
    };
</script>
