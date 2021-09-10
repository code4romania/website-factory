import { usePage } from '@inertiajs/inertia-vue3';
import isPlainObject from 'lodash/isPlainObject';
export default {
    data() {
        return {
            locale: this.$i18n.locale,
        };
    },
    computed: {
        locales() {
            return this.$i18n.availableLocales;
        },
        availableLocales() {
            return usePage().props.value.locales || [];
        },
        translatableFields() {
            return usePage().props.value.translatableFields || [];
        },
    },
    methods: {
        changeLocale(to) {
            if (!this.isValidLocale(to)) {
                return;
            }

            this.locale = to;
        },

        isValidLocale(locale) {
            return this.locales.includes(locale);
        },
        isCurrentLocale(locale) {
            return this.locale === locale;
        },
        isTranslatableField(field) {
            return this.translatableFields.includes(field);
        },
        translateField(field, model) {
            if (!this.isTranslatableField(field)) {
                return isPlainObject(model) ? model[field] || null : null;
            }

            let translatedField = {};

            this.locales.forEach((locale) => {
                if (isPlainObject(model)) {
                    const translation = model.translations.find(
                        (translation) => translation.locale === locale
                    );

                    translatedField[locale] = translation
                        ? translation[field] || null
                        : null;
                } else {
                    translatedField[locale] = null;
                }
            });

            return translatedField;
        },
    },
};
