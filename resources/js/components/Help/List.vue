<template>
    <div class="relative block border-b border-gray-200">
        <icon
            name="System/search-line"
            class="pointer-events-none absolute top-3.5 left-4 h-5 w-5 text-gray-400"
        />
        <input
            type="search"
            class="w-full h-12 pl-12 pr-4 text-gray-800 placeholder-gray-400 bg-transparent border-0 focus:ring-0 sm:text-sm"
            autocomplete="off"
            :placeholder="$t('app.search.placeholder')"
            @keydown.stop
            @keydown.enter.prevent
            v-model="query"
            ref="search"
        />
    </div>

    <div class="flex-1 p-4 overflow-y-auto divide-y divide-gray-200 sm:px-6">
        <div
            v-if="!results.length"
            class="flex flex-col items-center justify-center flex-1 gap-4 px-4 text-sm text-center py-14 sm:px-14"
        >
            <icon
                name="System/error-warning-line"
                class="w-6 h-6 mx-auto text-gray-400"
            />

            <p class="text-gray-900" v-text="$t('app.search.empty')" />
        </div>

        <template v-else v-for="(topics, section) in groupedResults">
            <div
                v-for="{ item } in topics"
                :key="`${section}/${item.topic}`"
                class="py-5"
            >
                <button
                    type="button"
                    class="w-full text-left group"
                    @click="$emit('topic:open', item)"
                >
                    <div class="flex items-start justify-between gap-2">
                        <h3
                            class="text-sm font-semibold text-gray-800 group-hover:underline"
                            v-text="item.title"
                        />

                        <help-section-badge
                            :section="item.section"
                            :index="item.sectionId"
                        />
                    </div>

                    <p
                        class="mt-2 text-sm text-gray-600 line-clamp-2"
                        v-text="item.excerpt"
                    />
                </button>
            </div>
        </template>

        <help-ask class="mt-8 !border-0 sm:mt-16" />
    </div>
</template>

<script>
    import groupBy from 'lodash/groupBy';
    import { computed, ref } from 'vue';
    import { useFuse } from '@vueuse/integrations/useFuse';

    export default {
        name: 'HelpList',
        props: {
            sections: {
                type: Array,
                required: true,
            },
        },
        emits: ['topic:open'],
        setup(props) {
            const query = ref('');

            const { results } = useFuse(query, props.sections, {
                fuseOptions: {
                    keys: ['title', 'section', 'content'],
                    ignoreLocation: true,
                    threshold: 0.33,
                },
                matchAllWhenSearchEmpty: true,
            });

            const groupedResults = computed(() =>
                groupBy(results.value, 'item.section')
            );

            return {
                query,
                results,
                groupedResults,
            };
        },
    };
</script>

