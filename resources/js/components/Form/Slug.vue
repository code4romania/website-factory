<template>
    <form-field
        :name="name"
        :label="label"
        :label-for="name"
        :help="null"
        :required="required"
        :disabled="disabled"
        :locale="locale"
    >
        <input
            class="block w-full border-inherit"
            :type="type"
            :name="name"
            :id="name"
            :required="required"
            :disabled="disabled"
            :autofocus="autofocus"
            v-bind="$attrs"
            :value="modelValue"
            @input="emit"
        />

        <a
            v-if="modelValue"
            :href="fullUrl"
            target="wf-preview"
            class="flex items-baseline mt-1 text-sm text-gray-600 hover:underline focus:underline"
        >
            <span v-text="fullUrl" />

            <icon-external-link class="w-3 h-3 ml-1 fill-current" />
        </a>
    </form-field>
</template>

<script>
    import IconExternalLink from 'remixicon/icons/System/external-link-line.svg';
    import InputMixin from '@/mixins/input';

    export default {
        name: 'FormSlug',
        mixins: [InputMixin],
        components: {
            IconExternalLink,
        },
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
        },
        computed: {
            fullUrl() {
                return this.route(this.routeName, {
                    locale: this.locale,
                    page: this.modelValue,
                });
            },
        },
    };
</script>

