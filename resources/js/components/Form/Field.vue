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
                v-if="showLocaleSwitchButton"
                type="button"
                @click="nextLocale"
                class="ml-2 text-xs font-medium text-center text-white uppercase bg-gray-400 w-7"
                v-text="locale"
            />
        </div>

        <div
            class="relative flex flex-wrap"
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
    import { computed } from 'vue';
    import { usePage } from '@inertiajs/inertia-vue3';
    import { useLocale } from '@/helpers';

    export default {
        name: 'FormField',
        props: {
            locale: {
                type: String,
                default: null,
            },
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
            help: {
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
        setup(props) {
            const { hasMultipleLocales, nextLocale } = useLocale(props);

            const errors = computed(() => {
                const initialErrors = usePage().props.value.errors;
                const errors = {};

                Object.keys(initialErrors).forEach((key) => {
                    const [name, locale] = key.split('.');

                    if (props.name === name) {
                        errors[locale] = initialErrors[key];
                    }
                });

                return errors;
            });

            const hasErrors = computed(() => Object.keys(errors.value).length > 0);

            const showLocaleSwitchButton = computed(
                () => props.locale !== null && hasMultipleLocales.value
            );

            return {
                errors,
                hasErrors,
                nextLocale,
                showLocaleSwitchButton,
            };
        },
    };
</script>
