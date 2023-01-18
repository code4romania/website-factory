<template>
    <div class="space-y-1">
        <div class="flex space-x-2">
            <label
                v-if="label"
                :for="labelFor"
                class="text-sm font-medium"
                :class="[hasErrors ? 'text-red-600' : 'text-gray-700']"
            >
                <span class="inline-block" v-text="label" />

                <span
                    role="presentation"
                    :title="$t('field.required')"
                    class="inline-block font-bold text-red-500 ml-0.5"
                    v-if="required && !disabled"
                    v-text="'*'"
                />
            </label>

            <button
                v-if="showLocaleSwitchButton"
                class="text-xs font-semibold text-center text-white uppercase bg-gray-400 w-7"
                type="button"
                @click="nextLocale"
                v-text="locale"
            />
        </div>

        <div
            class="relative flex flex-wrap"
            :class="[hasErrors ? 'border-red-600' : 'border-gray-400']"
        >
            <slot />
        </div>

        <p v-if="help" class="text-xs text-gray-500" v-text="help" />

        <div
            v-if="hasErrors"
            class="space-y-1 text-sm text-red-600"
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
    import { usePage } from '@inertiajs/vue3';
    import { defineInput, useLocale } from '@/helpers';

    export default defineInput({
        name: 'FormField',
        props: {
            labelFor: {
                type: String,
                default: null,
            },
        },
        setup(props) {
            const { hasMultipleLocales, nextLocale } = useLocale(props);

            const errors = computed(() => {
                const initialErrors = usePage().props.errors;

                if (!props.locale && initialErrors.hasOwnProperty(props.name)) {
                    return [initialErrors[props.name]];
                }

                const errors = {};

                Object.keys(initialErrors).forEach((key) => {
                    let parts = key.split('.');

                    const locale = parts.pop();
                    const name = parts.join('.');

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
    });
</script>
