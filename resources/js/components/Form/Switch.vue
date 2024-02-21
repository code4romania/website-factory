<template>
    <switch-group as="div" class="flex items-center gap-3">
        <switch-toggle
            :disabled="disabled"
            v-model="proxyChecked"
            class="relative inline-flex flex-shrink-0 h-6 transition-colors duration-200 ease-in-out border-2 border-transparent rounded-full w-11 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
            :class="{
                'bg-blue-600': proxyChecked && !disabled,
                'bg-gray-200': !proxyChecked && !disabled,
                'bg-blue-200': disabled,
                'cursor-pointer': !disabled,
            }"
        >
            <span
                :class="[
                    proxyChecked ? 'translate-x-5' : 'translate-x-0',
                    'pointer-events-none relative inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out',
                ]"
            >
                <icon
                    name="System/close-line"
                    class="absolute inset-0 flex items-center justify-center w-full h-full p-0.5 text-gray-400 transition-opacity"
                    :class="[
                        proxyChecked
                            ? 'opacity-0 ease-out duration-100'
                            : 'opacity-100 ease-in duration-200',
                    ]"
                />

                <icon
                    name="System/check-line"
                    class="absolute inset-0 flex items-center justify-center w-full h-full p-0.5 text-blue-600 transition-opacity"
                    :class="[
                        proxyChecked
                            ? 'opacity-100 ease-in duration-200'
                            : 'opacity-0 ease-out duration-100',
                    ]"
                />
            </span>
        </switch-toggle>

        <span class="flex flex-col flex-grow">
            <switch-label
                v-if="label"
                as="span"
                class="text-sm font-medium text-gray-700"
                :class="{
                    'cursor-pointer': !disabled,
                }"
            >
                <span v-text="label" />

                <span
                    role="presentation"
                    :title="$t('field.required')"
                    class="ml-1 font-bold text-red-500"
                    v-if="required"
                    v-text="'*'"
                />
            </switch-label>

            <switch-description
                v-if="help"
                as="span"
                class="text-sm text-gray-500"
            >
                {{ help }}
            </switch-description>
        </span>
    </switch-group>
</template>

<script>
    import { computed } from 'vue';
    import { defineInput } from '@/helpers';
    import {
        Switch as SwitchToggle,
        SwitchDescription,
        SwitchGroup,
        SwitchLabel,
    } from '@headlessui/vue';

    export default defineInput({
        name: 'FormSwitch',
        components: {
            SwitchToggle,
            SwitchDescription,
            SwitchGroup,
            SwitchLabel,
        },
        props: {
            value: {
                default: null,
            },
            checked: {
                type: Boolean,
            },
        },
        setup(props, { emit }) {
            const proxyChecked = computed({
                get: () => props.modelValue,
                set: (value) => emit('update:modelValue', value),
            });

            return {
                proxyChecked,
            };
        },
    });
</script>
