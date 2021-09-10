<template>
    <div v-if="availableLocales.length">
        <template v-for="locale in availableLocales">
            <component
                :key="locale"
                :is="type"
                v-if="locale === activeLocale"
                v-bind="$attrs"
                :name="`${$attrs.name}[${locale}]`"
                v-model="modelValue[locale]"
                :locale="locale"
            />
        </template>
    </div>
</template>

<script>
    import LocaleMixin from '@/mixins/locale';

    export default {
        name: 'LocalizedField',
        mixins: [LocaleMixin],
        inheritAttrs: false,
        props: {
            type: {
                type: String,
                required: true,
            },
            modelValue: {
                type: Object,
                default: () => ({}),
            },
        },

        emits: ['update:modelValue'],
    };
</script>
