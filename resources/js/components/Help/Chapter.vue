<template>
    <div :id="`chapter-${chapterKey}`" class="relative py-16">
        <div>
            <h2
                class="text-xl font-bold text-gray-900 sm:text-2xl"
                v-text="chapter.title"
            />
            <div
                class="mt-3 prose text-gray-500 max-w-prose sm:mt-4 empty:hidden"
                v-html="chapter.intro"
            />
        </div>

        <div class="grid mt-10 gap-y-12 md:grid-cols-2 xl:grid-cols-3 gap-x-5">
            <help-section
                v-for="(section, sectionKey) in chapter.sections"
                :key="`${chapterKey}/${sectionKey}`"
                :section="section"
                :chapter-key="chapterKey"
                :section-key="sectionKey"
            />
        </div>
    </div>
</template>

<script>
    export default {
        name: 'HelpChapter',
        props: {
            chapter: {
                type: Object,
                required: true,
            },
            chapterKey: {
                type: String,
                required: true,
            },
        },
    };
</script>
