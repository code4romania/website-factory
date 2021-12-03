<template>
    <li :data-depth="depth">
        <div class="relative border">
            <div class="relative flex items-stretch bg-gray-50">
                <div
                    class="handle flex-shrink-0 w-6 px-1.5 py-2 bg-gray-100 border-r cursor-move"
                >
                    <icon
                        name="drag"
                        class="w-full h-full text-gray-400"
                        local
                    />
                </div>

                <div
                    class="flex items-stretch flex-1 p-3 text-sm text-left text-gray-400 truncate focus:outline-none"
                >
                    <button
                        type="button"
                        @click="toggleOpen"
                        class="font-semibold text-left"
                        :class="[
                            hasErrors
                                ? 'text-red-600'
                                : 'text-gray-900 hover:text-blue-600',
                        ]"
                        v-text="itemLabel"
                    />

                    <button
                        v-if="item.children.length"
                        type="button"
                        @click="toggleCollapse"
                        class="ml-3 text-gray-400 hover:text-gray-900 focus:outline-none"
                    >
                        <icon
                            name="System/arrow-down-s-line"
                            class="w-5 h-5 text-gray-400"
                            :class="{ '-rotate-90': collapsed }"
                        />
                    </button>

                    <!-- <span v-if="true"> &mdash; {{ item.type }} </span> -->
                </div>

                <div
                    class="relative flex items-center flex-shrink-0 pr-3 space-x-3"
                >
                    <dropdown
                        trigger-class="flex items-center py-1 text-gray-400 hover:text-gray-900 focus:outline-none"
                        origin="top-right"
                        with-more
                    >
                        <template #content>
                            <dropdown-item
                                type="button"
                                @click="$emit('delete')"
                                v-text="$t('app.action.delete')"
                            />
                        </template>
                    </dropdown>
                </div>
            </div>

            <div
                v-if="open"
                class="px-4 py-5 space-y-8 bg-white border-t sm:p-6"
            >
                <localized-field
                    field="form-input"
                    :label="$t('field.label')"
                    :name="`${prefix}.label`"
                    v-model="item.label"
                    required
                />

                <form-select
                    :label="$t('field.type')"
                    v-model="item.type"
                    :options="types"
                />

                <template v-if="item.type === 'external'">
                    <localized-field
                        field="form-input"
                        type="url"
                        :label="$t('field.url')"
                        :name="`${prefix}.url`"
                        v-model="item.url"
                        required
                    />
                </template>

                <template v-else>
                    <form-select
                        :label="$t(`field.${item.type}`)"
                        :name="`${prefix}.model`"
                        v-model="item.model"
                        :options="models"
                        option-value-key="id"
                        option-label-key="title"
                    />
                </template>
            </div>
        </div>

        <menu-builder-list
            v-if="!collapsed && depth < maxDepth"
            class="pl-6 -mt-px"
            :items="item.children"
            :depth="depth + 1"
            :max-depth="maxDepth"
            :prefix="`${prefix}.children`"
        />
    </li>
</template>

<script>
    import { computed, ref, watch } from 'vue';
    import { usePage } from '@inertiajs/inertia-vue3';
    import { useLocale } from '@/helpers';
    import get from 'lodash/get';

    export default {
        name: 'MenuBuilderItem',
        props: {
            item: {
                type: Object,
                required: true,
            },
            children: {
                type: Array,
                default: () => [],
            },
            index: {
                type: Number,
                default: 0,
            },
            depth: {
                type: Number,
                default: 0,
            },
            maxDepth: {
                type: Number,
                default: 2,
            },
            prefix: {
                type: String,
                required: true,
            },
        },
        emits: ['delete'],
        setup(props) {
            const { currentLocale } = useLocale();

            const types = usePage().props.value.types || [];

            const models = computed(() => {
                return usePage().props.value.models[props.item.type] || [];

                if (!props.models.hasOwnProperty(props.item.type)) {
                    return [];
                }

                return props.models[props.item.type];

                if (props.item.type === 'page') {
                    return usePage().props.value.items.pages || [];
                }
            });

            const itemLabel = computed(() =>
                get(props.item, `label.${currentLocale.value}`, null)
            );

            const collapsed = ref(false);
            const toggleCollapse = () => {
                collapsed.value = !collapsed.value;
            };

            const open = ref(false);
            const toggleOpen = () => {
                open.value = !open.value;
            };

            const prefix = computed(() => `${props.prefix}.${props.index}`);

            const errors = computed(() => {
                const initialErrors = usePage().props.value.errors;
                const errors = {};

                Object.keys(initialErrors).forEach((key) => {
                    if (
                        key.startsWith(prefix.value) &&
                        !key.startsWith(prefix.value + '.children')
                    ) {
                        errors[key] = initialErrors[key];
                    }
                });

                return errors;
            });

            const hasErrors = computed(() => Object.keys(errors.value).length > 0);

            watch(
                open,
                () => {
                    if (!itemLabel.value) {
                        open.value = true;
                    }
                },
                { immediate: true }
            );

            return {
                types,
                models,
                itemLabel,
                collapsed,
                toggleCollapse,
                open,
                toggleOpen,
                prefix,
                errors,
                hasErrors,
            };
        },
    };
</script>
