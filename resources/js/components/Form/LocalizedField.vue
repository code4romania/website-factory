<template>
    <div v-if="localeIds.length">
        <template v-for="locale in localeIds">
            <component
                :key="locale"
                :is="field"
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
            field: {
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
            const { localeIds, currentLocale } = useLocale(props);

            return {
                currentLocale,
                localeIds,
            };
        },
    };
</script>
