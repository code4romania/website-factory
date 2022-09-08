<template>
    <div class="p-4 border-b sm:px-6">
        <div class="flex items-center gap-2">
            <h1 class="flex font-medium text-gray-900" v-text="topic.title" />
        </div>
    </div>

    <div class="px-4 py-1 text-sm border-b bg-gray-50">
        <button
            type="button"
            @click="$emit('topic:close')"
            class="flex items-center text-xs font-medium text-gray-500 hover:text-gray-700"
        >
            <icon
                name="System/arrow-drop-left-line"
                class="w-5 h-5 -ml-1 text-gray-500 shrink-0"
            />

            <span v-text="$t('app.action.back')" />
        </button>
    </div>

    <div
        class="flex-1 p-4 overflow-y-auto prose-sm prose sm:px-6 prose-blue"
        v-html="topic.content"
    />
</template>

<script>
    export default {
        name: 'HelpTopic',
        props: {
            topic: {
                type: Object,
                required: true,
            },
        },
        emits: ['topic:close'],
    };
</script>
