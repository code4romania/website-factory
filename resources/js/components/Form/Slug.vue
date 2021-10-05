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
    import InputMixin from '@/mixins/input';

    export default {
        name: 'FormSlug',
        mixins: [InputMixin],
        inheritAttrs: false,
        props: {
            type: {
                type: String,
                default: 'text',
            },
            routeName: {
                type: String,
                required: true,
            },
            source: {
                type: Object,
                default: null,
            },
        },
        computed: {
            fullUrl() {
                if (!this.modelValue) {
                    return null;
                }

                return this.route(this.routeName, {
                    locale: this.locale,
                    page: this.modelValue,
                });
            },
        },
        watch: {
            source: {
                deep: true,
                handler(source) {
                    if (!source) {
                        return;
                    }

                    this.emit(
                        source[this.locale] ? slug(source[this.locale]) : null
                    );
                },
            },
        },
    };
</script>

