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
    import { computed, onMounted } from 'vue';
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
            default: {
                type: [String, Number],
                default: null,
            },
        },
        setup(props, { emit }) {
            const { getOptionForLocale } = useLocale();

            const options = computed(() =>
                props.options.map((option) => ({
                    value: getOptionForLocale(option, props.optionValueKey),
                    label: getOptionForLocale(option, props.optionLabelKey),
                }))
            );

            const proxySelected = computed({
                get: () => props.modelValue,
                set: (selected) => emit('update:modelValue', selected),
            });

            onMounted(() => {
                if (props.modelValue === null) {
                    proxySelected.value = props.default;
                }
            });

            return {
                options,
                proxySelected,
            };
        },
    });
</script>

