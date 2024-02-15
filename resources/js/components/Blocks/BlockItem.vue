<template>
    <section class="bg-white border">
        <header class="relative flex items-stretch bg-gray-50">
            <div
                class="handle shrink-0 px-1.5 py-2.5 bg-gray-100 border-r cursor-move flex items-center"
            >
                <icon name="drag" class="w-2.5 h-6 text-gray-400" />
            </div>

            <button
                type="button"
                @click="toggleOpen"
                class="flex flex-1 p-3 overflow-hidden text-sm font-semibold text-left text-gray-400 truncate gap-x-1 focus:outline-none"
            >
                <icon
                    v-if="icon"
                    :name="icon"
                    class="w-5 h-5 mr-1 text-gray-500 shrink-0 group-hover:text-gray-600"
                />

                <h1 class="text-gray-900" v-text="$t(name)" />

                <span v-if="title" class="truncate">&mdash; {{ title }}</span>
            </button>

            <div class="relative flex items-center pr-3 gap-x-3 shrink-0">
                <button
                    v-if="canExpand"
                    type="button"
                    @click="toggleWidth"
                    class="text-gray-400 hover:text-gray-900 focus:outline-none"
                >
                    <icon
                        v-if="content.fullwidth"
                        name="Design/layout-column-line"
                        class="block w-4 h-4"
                    />

                    <icon
                        v-else
                        name="Design/layout-column-fill"
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

        <div v-show="open" class="px-4 py-5 space-y-8 border-t sm:p-6">
            <component
                :is="component"
                :id="id"
                :content="content"
                @update:content="emit('update:content', $event)"
                :children="children"
                @update:children="emit('update:children', $event)"
                :media="media"
                @update:media="emit('update:media', $event)"
                :related="related"
                @update:related="emit('update:related', $event)"
                :parameters="parameters"
            />

            <details v-if="$page.props.app.debug">
                <summary class="text-sm cursor-pointer">Debug</summary>
                <div class="p-3 text-sm bg-gray-100">
                    <pre class="whitespace-pre-line">
                        id: {{ id }}
                        component: {{ component }}
                        content:
                    </pre>

                    <pre class="whitespace-pre-wrap" v-text="content" />

                    <pre class="mt-4 whitespace-pre-line">
                        children:
                    </pre>

                    <pre class="whitespace-pre-wrap" v-text="children" />

                    <pre class="mt-4 whitespace-pre-line">
                        media:
                    </pre>

                    <pre class="whitespace-pre-wrap" v-text="media" />

                    <pre class="mt-4 whitespace-pre-line">
                        related:
                    </pre>

                    <pre class="whitespace-pre-wrap" v-text="related" />

                    <pre class="mt-4 whitespace-pre-line">
                        parameters:
                    </pre>

                    <pre class="whitespace-pre-wrap" v-text="parameters" />
                </div>
            </details>
        </div>
    </section>
</template>

<script>
    import { computed, ref, watch } from 'vue';
    import { usePage } from '@inertiajs/vue3';
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
                validator: (type) => ['block', 'repeater', 'form'].includes(type),
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
            related: {
                type: Array,
                default: () => [],
            },
            parameters: {
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
            open: {
                type: Boolean,
                default: true,
            },
        },
        emits: ['duplicate', 'delete'],
        setup(props) {
            const { currentLocale } = useLocale();

            const component = computed(() =>
                `${props.type}-${props.component}`.toLowerCase()
            );

            const name = computed(() => `block.${props.component}`);
            const title = computed(() =>
                get(props.content, `title.${currentLocale.value}`, null)
            );

            const icon = computed(() => {
                const block = usePage().props.model.allowed_blocks.find(
                    ({ type }) => type === props.component
                );

                if (typeof block === 'undefined' || !block.hasOwnProperty('icon')) {
                    return null;
                }

                return block.icon;
            });

            const toggleWidth = () => {
                props.content.fullwidth = !props.content.fullwidth;
            };

            const open = ref(true);

            const toggleOpen = () => {
                open.value = !open.value;
            };

            watch(
                () => props.open,
                (value) => (open.value = value)
            );

            return {
                currentLocale,
                component,

                name,
                title,
                icon,
                toggleWidth,

                open,
                toggleOpen,
            };
        },
    };
</script>
