<template>
    <div>
        <div class="flex space-x-2">
            <input
                type="checkbox"
                :id="id"
                class="text-blue-600 border-gray-300 rounded shadow-sm  focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                :value="value"
                v-model="proxyChecked"
                v-bind="$attrs"
            />

            <form-label
                :for="id"
                :value="label || null"
                :disabled="$attrs.disabled"
            />
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
    </div>
</template>

<script>
    export default {
        name: 'FormCheckbox',
        inheritAttrs: false,
        props: {
            checked: {
                type: Boolean,
                default: false,
            },
            value: {
                default: null,
            },
            label: {
                type: String,
                default: null,
            },
            id: {
                type: String,
                default: () => Math.random().toString(36).substring(8),
            },
            help: {
                type: String,
                default: null,
            },
        },
        emits: ['update:checked'],

        computed: {
            proxyChecked: {
                get() {
                    return this.checked;
                },

                set(value) {
                    this.$emit('update:checked', value);
                },
            },
        },
    };
</script>
