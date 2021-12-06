<template>
    <a
        v-if="modelValue"
        :href="fullUrl"
        target="wf-preview"
        class="flex items-baseline max-w-full text-sm text-gray-600 hover:underline focus:underline"
    >
        <span v-text="fullUrl" />

        <icon
            name="System/external-link-line"
            class="flex-shrink-0 w-3 h-3 ml-1"
        />
    </a>
</template>

<script>
    import slug from 'slug';
    import { computed, watch } from 'vue';
    import { route, useLocale } from '@/helpers';

    export default {
        name: 'FormSlug',
        props: {
            routeName: {
                type: String,
                required: true,
            },
            routeKey: {
                type: String,
                required: true,
            },
            modelValue: {
                type: String,
                default: null,
            },
            source: {
                type: [Object, String],
                default: null,
            },
            translatable: {
                type: Boolean,
                default: false,
            },
            locale: {
                type: String,
                default: null,
            },
        },
        setup(props, { emit }) {
            const { currentLocale } = useLocale();

            const fullUrl = computed(() => {
                if (!props.modelValue) {
                    return null;
                }

                return route(props.routeName, {
                    locale: props.locale || currentLocale.value,
                    [props.routeKey]: props.modelValue,
                });
            });

            const update = (source) => {
                emit('update:modelValue', source ? slug(source) : null);
            };

            watch(
                () => props.source,
                (source) => {
                    if (!source) {
                        return;
                    }

                    update(
                        props.translatable && props.locale
                            ? source[props.locale]
                            : source
                    );
                },
                { deep: true }
            );

            return {
                fullUrl,
            };
        },
    };
</script>

