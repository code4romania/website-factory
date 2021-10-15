<template>
    <div v-if="locales.length">
        <template v-for="locale in locales">
            <component
                :key="locale"
                :is="type"
                v-if="locale === currentLocale"
                v-bind="$attrs"
                v-model="modelValue[locale]"
                :locale="locale"
            >
                <template v-for="(_, name) in $slots" v-slot:[name]="slotData">
                    <slot :name="name" v-bind="slotData" />
                </template>
            </component>
        </template>
    </div>
</template>

<script>
    import { useLocale } from '@/helpers';

    export default {
        name: 'LocalizedField',
        inheritAttrs: false,
        props: {
            locale: {
                type: String,
                default: null,
            },
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
        setup(props) {
            const { locales, currentLocale } = useLocale(props);

            return {
                currentLocale,
                locales,
            };
        },
    };
</script>
