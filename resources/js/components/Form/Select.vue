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
        <button
            v-if="isClearable"
            class="absolute top-0 bottom-0 px-2 text-gray-500 right-8 hover:text-red-600"
            @click="clear"
        >
            <icon name="System/close-line" class="w-5 h-5 shrink-0" />
        </button>

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
            clearable: {
                type: Boolean,
                default: false,
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

            const clear = () => {
                proxySelected.value = props.default;
            };

            onMounted(() => {
                if (props.modelValue === null) {
                    clear();
                }
            });

            const isClearable = computed(
                () => props.clearable && props.modelValue !== props.default
            );

            return {
                options,
                proxySelected,
                isClearable,
                clear,
            };
        },
    });
</script>

