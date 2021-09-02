<template>
    <section class="bg-white border">
        <header class="flex items-stretch bg-gray-50">
            <div
                class="
                    handle
                    flex-shrink-0
                    w-5
                    px-1.5
                    py-2
                    bg-gray-100
                    border-r
                    cursor-move
                "
            >
                <icon name="drag" class="w-full h-full text-gray-400" local />
            </div>

            <div class="flex-1 p-3">
                <h1 class="text-sm font-medium" v-text="type" />
            </div>

            <div class="flex items-center pr-3 space-x-2">
                <button
                    type="button"
                    @click="$emit('update:fullwidth', !fullwidth)"
                    class="text-gray-400 hover:text-gray-900"
                >
                    <icon
                        v-if="fullwidth"
                        name="Media/fullscreen-exit-line"
                        class="w-4 h-4"
                    />
                    <icon v-else name="Media/fullscreen-line" class="w-4 h-4" />
                </button>

                <button
                    type="button"
                    @click="$emit('delete')"
                    class="text-gray-400 hover:text-red-500"
                >
                    <icon name="System/delete-bin-line" class="w-4 h-4" />
                </button>
            </div>
        </header>

        <div class="px-4 py-5 sm:p-6">
            <pre class="whitespace-pre-line">
                id: {{ id }}
                type: {{ type }}
                fullwidth: {{ fullwidth }}
            </pre>
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
            fullwidth: {
                type: Boolean,
                required: true,
            },
        },

        emits: [
            //
            'update:fullwidth',
            'delete',
        ],

        setup() {
            return {
                //
            };
        },
    };
</script>
