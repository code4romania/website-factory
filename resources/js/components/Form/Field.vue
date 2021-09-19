<template>
    <div>
        <div class="flex mb-1">
            <label
                v-if="label"
                :for="labelFor"
                class="block w-full text-sm font-medium"
                :class="[hasErrors ? 'text-red-600' : 'text-gray-700']"
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
                class="ml-2 text-xs font-medium text-center text-white uppercase bg-gray-400 w-7"
                v-text="locale"
            />
        </div>

        <div
            class="relative flex"
            :class="[hasErrors ? 'border-red-600' : 'border-gray-400']"
        >
            <slot />
        </div>

        <div
            v-if="hasErrors"
            class="mt-2 space-y-1 text-sm text-red-600"
            role="alert"
        >
            <p
                v-for="(message, locale) in errors"
                :key="locale"
                v-text="message"
            />
        </div>
    </div>
</template>

<script>
    import { usePage } from '@inertiajs/inertia-vue3';

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
            hasErrors() {
                return Object.keys(this.errors).length > 0;
            },
            errors() {
                const initialErrors = usePage().props.value.errors;
                const errors = {};

                Object.keys(initialErrors).forEach((key) => {
                    const [name, locale] = key.split('.');

                    if (this.name === name) {
                        errors[locale] = initialErrors[key];
                    }
                });

                return errors;
            },
        },
    };
</script>
