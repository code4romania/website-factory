<template>
    <form-field
        :name="name"
        :label="label"
        :label-for="id"
        :help="help"
        :required="required"
        :disabled="disabled"
        :locale="locale"
    >
        <select
            class="block w-full border-inherit"
            :id="id"
            :required="required"
            :disabled="disabled"
            :autofocus="autofocus"
            v-bind="$attrs"
            v-model="proxySelected"
        >
            <option :value="null" disabled>&mdash;</option>

            <option
                v-for="{ value, label } in options"
                :key="value"
                :value="value"
                v-text="label"
            />
        </select>
    </form-field>
</template>

<script>
    import { computed } from 'vue';
    import { defineInput, useLocale } from '@/helpers';

    export default defineInput({
        name: 'FormSelect',
        props: {
            options: {
                type: Array,
                default: () => [],
            },
            optionValueKey: {
                type: String,
                default: 'value',
            },
            optionLabelKey: {
                type: String,
                default: 'label',
            },
        },
        setup(props, { emit }) {
            const { currentLocale } = useLocale();

            const get = (option, key) => {
                return option.hasOwnProperty(key)
                    ? option[key][currentLocale.value] || option[key]
                    : option[currentLocale.value] || option || null;
            };

            const options = computed(() =>
                props.options.map((option) => ({
                    value: get(option, props.optionValueKey),
                    label: get(option, props.optionLabelKey),
                }))
            );

            const proxySelected = computed({
                get: () => props.modelValue,
                set: (selected) => emit('update:modelValue', selected),
            });

            return {
                options,
                proxySelected,
            };
        },
    });
</script>

