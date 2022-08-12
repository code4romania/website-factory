<template>
    <article
        class="flex flex-col justify-between flex-1 overflow-hidden bg-white shadow-lg"
    >
        <div class="flex-1 p-6 prose">
            <h4 class="mb-0">
                <inertia-link
                    :href="url"
                    class="no-underline hover:underline hover:text-blue-600 focus:text-blue-600"
                    v-text="section.title"
                />
            </h4>
            <div class="line-clamp-3" v-html="section.intro" />
        </div>

        <div class="flex justify-end p-6 pt-0">
            <inertia-link
                class="flex items-center text-sm font-medium text-blue-600 hover:underline"
                :href="url"
            >
                <span v-text="$t('app.banner.more')" />

                <icon
                    name="System/arrow-right-line"
                    class="w-4 h-4 ml-2 shrink-0"
                />
            </inertia-link>
        </div>
    </article>
</template>

<script>
    import { computed } from 'vue';
    import { route } from '@/helpers';

    export default {
        name: 'HelpSection',
        props: {
            section: {
                type: Object,
                required: true,
            },
            chapterKey: {
                type: String,
                required: true,
            },
            sectionKey: {
                type: String,
                required: true,
            },
        },
        setup(props) {
            const url = computed(() =>
                route('admin.help.section', {
                    section: `${props.chapterKey}/${props.sectionKey}`,
                })
            );

            return {
                url,
            };
        },
    };
</script>
