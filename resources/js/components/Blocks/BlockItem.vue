<template>
    <section class="bg-white border">
        <header class="flex items-stretch bg-gray-50">
            <div
                class="handle flex-shrink-0 w-5 px-1.5 py-2 bg-gray-100 border-r cursor-move"
            >
                <icon-drag class="w-full h-full text-gray-400 fill-current" />
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
                    <component
                        :is="content.fullwidth ? 'icon-reduce' : 'icon-enlarge'"
                        class="w-4 h-4 fill-current"
                    />
                </button>

                <button
                    type="button"
                    @click="$emit('delete')"
                    class="text-gray-400 hover:text-red-500"
                >
                    <icon-delete class="w-4 h-4 fill-current" />
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

    import IconReduce from 'remixicon/icons/Media/fullscreen-exit-line.svg';
    import IconEnlarge from 'remixicon/icons/Media/fullscreen-line.svg';
    import IconDelete from 'remixicon/icons/System/delete-bin-line.svg';
    import IconDrag from '~/svg/drag.svg';

    export default {
        name: 'BlockItem',
        components: {
            IconReduce,
            IconEnlarge,
            IconDelete,
            IconDrag,
        },
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
