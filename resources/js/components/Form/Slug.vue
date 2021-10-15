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
    import { route } from '@/helpers';

    export default {
        name: 'FormSlug',
        props: {
            routeName: {
                type: String,
                required: true,
            },
            modelValue: {
                type: String,
                default: null,
            },
            source: {
                type: Object,
                default: null,
            },
            locale: {},
        },
        setup(props, { emit }) {
            const fullUrl = computed(() => {
                if (!props.modelValue) {
                    return null;
                }

                return route(props.routeName, {
                    locale: props.locale,
                    page: props.modelValue,
                });
            });

            watch(
                () => props.source,
                (source) => {
                    console.log(source);
                    if (!source) {
                        return;
                    }

                    emit(
                        'update:modelValue',
                        source[props.locale] ? slug(source[props.locale]) : null
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

