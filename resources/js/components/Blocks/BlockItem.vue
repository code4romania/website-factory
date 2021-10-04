<template>
    <section class="bg-white border">
        <header class="flex items-stretch bg-gray-50">
            <div
                class="handle flex-shrink-0 w-5 px-1.5 py-2 bg-gray-100 border-r cursor-move"
            >
                <icon name="drag" class="w-full h-full text-gray-400" local />
            </div>

            <div class="flex-1 p-3">
                <h1 class="text-sm font-medium" v-text="$t(`block.${type}`)" />
            </div>

            <div class="flex items-center pr-3 space-x-2">
                <button
                    type="button"
                    @click="toggleWidth"
                    class="text-gray-400 hover:text-gray-900"
                >
                    <icon
                        v-if="content.fullwidth"
                        name="Media/fullscreen-exit-line"
                        class="block w-4 h-4"
                    />

                    <icon
                        v-else
                        name="Media/fullscreen-line"
                        class="block w-4 h-4"
                    />
                </button>

                <button
                    type="button"
                    @click="$emit('delete')"
                    class="text-gray-400 hover:text-red-500"
                >
                    <icon name="System/delete-bin-line" class="block w-4 h-4" />
                </button>
            </div>
        </header>

        <div class="px-4 py-5 space-y-8 sm:p-6">
            <component :is="blockType" v-model:content="content" />

            <details v-if="$page.props.app.debug">
                <summary>Debug</summary>
                <div class="p-3 text-sm bg-gray-100">
                    <pre class="whitespace-pre-line">
                        id: {{ id }}
                        type: {{ type }}
                        content:
                    </pre>

                    <pre class="whitespace-pre-wrap" v-text="content" />
                </div>
            </details>
        </div>
    </section>
</template>

<script>
    import { computed } from 'vue';

    export default {
        name: 'BlockItem',
        props: {
            id: {
                type: [String, Number],
                required: true,
            },
            type: {
                type: String,
                required: true,
            },
            content: {
                type: Object,
                required: true,
            },
        },
        emits: ['delete'],
        setup(props) {
            const blockType = computed(
                () => `block-type-${props.type.toLowerCase()}`
            );
            const toggleWidth = () => {
                props.content.fullwidth = !props.content.fullwidth;
            };

            return {
                blockType,
                toggleWidth,
            };
        },
    };
</script>
