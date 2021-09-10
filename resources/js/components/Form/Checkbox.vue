<template>
    <div>
        <div class="flex space-x-2">
            <input
                type="checkbox"
                :id="id"
                class="text-blue-600 border-gray-300 rounded shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                v-model="proxyChecked"
                v-bind="$attrs"
            />

            <form-label
                :target="id"
                :text="label"
                :required="required"
                :disabled="disabled"
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
    import InputMixin from '@/mixins/input';

    export default {
        name: 'FormCheckbox',
        mixins: [InputMixin],
        props: {
            modelValue: {
                type: Boolean,
                default: false,
            },
        },

        computed: {
            proxyChecked: {
                get() {
                    return this.modelValue;
                },

                set(value) {
                    this.emit(value);
                },
            },
        },
    };
</script>
