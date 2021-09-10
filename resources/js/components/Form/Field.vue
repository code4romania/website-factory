<template>
    <div>
        <div class="flex mb-1">
            <label
                v-if="label"
                :for="labelFor"
                class="block w-full text-sm font-medium text-gray-700"
            >
                <span v-html="label" />

                <span
                    role="presentation"
                    :title="$t('field.required')"
                    class="ml-1 font-bold text-red-500"
                    v-if="required && !disabled"
                    v-text="'*'"
                />
            </label>

            <button
                v-if="locale"
                type="button"
                @click="nextLocale"
                class="ml-2 text-xs font-medium text-center text-white uppercase bg-gray-400 rounded-sm w-7"
                v-text="locale"
            />
        </div>

        <slot />

        <span
            v-if="hasErrors"
            class="mt-2 text-sm text-red-600"
            role="alert"
            v-text="message"
        />
    </div>
</template>

<script>
    import LocaleMixin from '@/mixins/locale';

    export default {
        name: 'FormField',
        mixins: [LocaleMixin],
        props: {
            name: {
                type: String,
                required: true,
            },
            label: {
                type: String,
                default: null,
            },
            labelFor: {
                type: String,
                default: null,
            },
            helpText: {
                type: String,
                default: null,
            },
            required: {
                type: Boolean,
                default: false,
            },
            disabled: {
                type: Boolean,
                default: false,
            },
        },
        computed: {
            errorKey() {
                return this.locale ? `${this.locale}.${this.name}` : this.name;
            },
            hasErrors() {
                return this.message !== null;
            },
            message() {
                return null;
            },
        },
    };
</script>
