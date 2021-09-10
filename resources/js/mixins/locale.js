import { usePage } from '@inertiajs/inertia-vue3';
import isPlainObject from 'lodash/isPlainObject';
export default {
    props: {
        locale: {
            type: String,
            default: null,
        },
    },
    computed: {
        hasLocale() {
            return this.locale !== null;
        },
        isActiveLocale() {
            return this.hasLocale ? this.locale === this.activeLocale : true;
        },
        availableLocales() {
            return usePage().props.value.locales || [];
        },
        activeLocale: {
            get() {
                return this.$i18n.locale;
            },

            set(locale) {
                this.$i18n.locale = locale;
            },
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

            this.activeLocale = to;
        },
        nextLocale() {
            const next =
                this.availableLocales[
                    this.availableLocales.indexOf(this.locale) + 1
                ] || this.availableLocales[0];

            this.changeLocale(next);
        },
        isValidLocale(locale) {
            return this.availableLocales.includes(locale);
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
