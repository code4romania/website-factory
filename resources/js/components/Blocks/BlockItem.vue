<template>
    <section class="bg-white border">
        <header class="flex items-stretch bg-gray-50">
            <div
                class="handle flex-shrink-0 w-5 px-1.5 py-2 bg-gray-100 border-r cursor-move"
            >
                <img
                    src="~/svg/drag.svg"
                    class="w-full h-full text-gray-400 fill-current"
                    svg-inline
                />
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
                    <img
                        v-if="content.fullwidth"
                        src="remixicon/icons/Media/fullscreen-exit-line.svg"
                        class="w-4 h-4 fill-current"
                        svg-inline
                    />
                    <img
                        v-else
                        src="remixicon/icons/Media/fullscreen-line.svg"
                        class="w-4 h-4 fill-current"
                        svg-inline
                    />
                </button>

                <button
                    type="button"
                    @click="$emit('delete')"
                    class="text-gray-400 hover:text-red-500"
                >
                    <img
                        src="remixicon/icons/System/delete-bin-line.svg"
                        class="w-4 h-4 fill-current"
                        svg-inline
                    />
                </button>
            </div>
        </header>

        <div class="px-4 py-5 space-y-8 sm:p-6">
            <component :is="component" v-model:content="content" />

            <details>
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

        computed: {
            component() {
                return `content-block-${this.type.toLowerCase()}`;
            },
        },

        methods: {
            toggleWidth() {
                this.content.fullwidth = !this.content.fullwidth;
            },
        },
    };
</script>
