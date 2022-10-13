<template>
    <div v-bind="$attrs">
        <form-field
            :name="name"
            :label="label"
            :label-for="id"
            :help="help"
            :required="required"
            :disabled="disabled"
            :locale="locale"
        >
            <div class="flex flex-wrap gap-4">
                <label
                    v-for="(option, index) in options"
                    class="flex space-x-2"
                    :key="index"
                >
                    <input
                        type="radio"
                        :name="name"
                        class="text-blue-600 border-gray-300 rounded-full shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 my-0.5"
                        v-model="proxyChecked"
                        :value="option.value"
                        :required="required"
                        :disabled="disabled"
                        :autofocus="autofocus"
                    />

                    <span
                        class="text-sm font-medium text-gray-700"
                        v-text="option.label"
                    />
                </label>
            </div>

            <p
                v-if="help"
                class="mt-1 ml-6 text-sm"
                :class="{
                    'text-gray-300': $attrs.disabled,
                    'text-gray-500': !$attrs.disabled,
                }"
                v-text="help"
            />
        </form-field>
    </div>
</template>

<script>
    import { computed, onMounted } from 'vue';
    import { defineInput, useLocale } from '@/helpers';

    export default defineInput({
        name: 'FormRadioGroup',
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

            const proxyChecked = computed({
                get: () => props.modelValue,
                set: (value) => emit('update:modelValue', value),
            });

            onMounted(() => {
                if (props.modelValue === null) {
                    proxyChecked.value = options.value[0].value;
                }
            });

            return {
                options,
                proxyChecked,
            };
        },
    });
</script>
