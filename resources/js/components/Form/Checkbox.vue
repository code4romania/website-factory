<template>
    <div>
        <div class="flex space-x-2">
            <input
                type="checkbox"
                :id="name"
                :name="name"
                class="text-blue-600 border-gray-300 rounded shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                v-model="proxyChecked"
                v-bind="$attrs"
            />

            <form-label
                v-if="label"
                :target="name"
                :text="label"
                :required="required && !disabled"
                class="text-gray-700"
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
            help: {
                type: String,
                default: null,
            },
        },
        computed: {
            proxyChecked: {
                get() {
                    return !!this.modelValue;
                },
                set(value) {
                    this.emit(value);
                },
            },
        },
    };
</script>
