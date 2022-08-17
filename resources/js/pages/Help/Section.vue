<template>
    <layout
        :title="help.section.title"
        :breadcrumbs="[
            {
                label: $t('app.dashboard'),
                url: route('admin.dashboard'),
            },
            {
                label: $t('help.label'),
                url: route('admin.help.index'),
            },
            {
                label: help.chapter.title,
                url: route('admin.help.index') + `#chapter-${help.chapter.key}`,
            },
        ]"
    >
        <template #subnav>
            <ask-for-help />
        </template>

        <div class="grid items-start gap-8 lg:grid-cols-2">
            <div
                class="prose text-gray-700 prose-blue max-w-prose"
                v-html="help.section.content"
            />

            <figure v-if="help.section.video">
                <div class="aspect-w-16 aspect-h-9">
                    <iframe
                        :src="`https://www.youtube.com/embed/${help.section.video.id}?modestbranding=1&rel=0`"
                        frameborder="0"
                        allow="encrypted-media; picture-in-picture"
                        allowfullscreen
                    />
                </div>

                <figcaption
                    v-if="help.section.video.caption"
                    v-text="help.section.video.caption"
                    class="mt-3 text-sm italic text-gray-500"
                />
            </figure>
        </div>
    </layout>
</template>

<script>
    export default {
        props: {
            help: Object,
        },
    };
</script>
