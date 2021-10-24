<template>
    <section class="bg-white border">
        <header class="relative flex items-stretch bg-gray-50">
            <div
                class="handle flex-shrink-0 w-5 px-1.5 py-2 bg-gray-100 border-r cursor-move"
            >
                <icon name="drag" class="w-full h-full text-gray-400" local />
            </div>

            <button
                type="button"
                @click="toggleOpen"
                class="flex-1 p-3 text-left text-gray-400 truncate focus:outline-none"
            >
                <h1 class="text-sm font-medium truncate">
                    <span class="text-gray-900" v-t="blockName" />

                    <span v-if="blockTitle && !open">
                        &mdash; {{ blockTitle }}
                    </span>
                </h1>
            </button>

            <div
                class="relative flex items-center flex-shrink-0 pr-3 space-x-3"
            >
                <button
                    v-if="canExpand"
                    type="button"
                    @click="toggleWidth"
                    class="text-gray-400 hover:text-gray-900 focus:outline-none"
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
                    @click="toggleOpen"
                    class="text-gray-400 hover:text-gray-900 focus:outline-none"
                >
                    <icon
                        name="System/arrow-down-s-line"
                        class="w-5 h-5 text-gray-400"
                        :class="{ 'rotate-180': open }"
                    />
                </button>

                <dropdown
                    trigger-class="flex items-center py-1 text-gray-400 hover:text-gray-900 focus:outline-none"
                    origin="top-right"
                    with-more
                >
                    <template #content>
                        <dropdown-item
                            v-if="canDuplicate"
                            type="button"
                            @click="$emit('duplicate')"
                            v-text="$t('app.action.duplicate')"
                        />

                        <dropdown-item
                            type="button"
                            @click="$emit('delete')"
                            v-text="$t('app.action.delete')"
                        />
                    </template>
                </dropdown>
            </div>
        </header>

        <div v-show="open" class="px-4 py-5 space-y-8 sm:p-6">
            <component
                :is="component"
                v-model:content="content"
                v-model:children="children"
                v-model:media="media"
            />

            <details v-if="$page.props.app.debug">
                <summary>Debug</summary>
                <div class="p-3 text-sm bg-gray-100">
                    <pre class="whitespace-pre-line">
                        id: {{ id }}
                        component: {{ component }}
                        content:
                    </pre>

                    <pre class="whitespace-pre-wrap" v-text="content" />
                </div>
            </details>
        </div>
    </section>
</template>

<script>
    import { computed, ref } from 'vue';
    import { useLocale } from '@/helpers';
    import get from 'lodash/get';

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
                validator: (type) => ['item', 'repeater'].includes(type),
            },
            component: {
                type: String,
                required: true,
            },
            content: {
                type: Object,
                required: true,
            },
            children: {
                type: Array,
                default: () => [],
            },
            media: {
                type: Array,
                default: () => [],
            },
            canDuplicate: {
                type: Boolean,
                default: false,
            },
            canExpand: {
                type: Boolean,
                default: false,
            },
        },
        emits: ['duplicate', 'delete'],
        setup(props) {
            const { currentLocale } = useLocale();

            const component = computed(() =>
                `block-${props.type}-${props.component}`.toLowerCase()
            );

            const blockName = computed(() => `block.${props.component}`);
            const blockTitle = computed(() =>
                get(props.content, `title.${currentLocale.value}`, null)
            );

            const toggleWidth = () => {
                props.content.fullwidth = !props.content.fullwidth;
            };

            const open = ref(true);

            const toggleOpen = () => {
                open.value = !open.value;
            };

            return {
                currentLocale,
                component,
                blockName,
                blockTitle,
                toggleWidth,

                open,
                toggleOpen,
            };
        },
    };
</script>
