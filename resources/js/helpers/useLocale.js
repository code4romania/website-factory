import { usePage } from '@inertiajs/inertia-vue3';
import { computed } from 'vue';

export default function (props) {
    const locales = computed(
        () => usePage().props.value.locales.available || {}
    );
    const activeLocales = computed(
        () => usePage().props.value.locales.active || []
    );
    const translatableFields = computed(
        () => usePage().props.value.model.translatable || []
    );
    const currentLocale = computed({
        get: () => usePage().props.value.locales.current,
        set: (locale) => (usePage().props.value.locales.current = locale),
    });
    const localeIds = computed(() => Object.keys(locales.value));

    const hasLocale = computed(() => props.locale !== null);
    const hasMultipleLocales = computed(() => localeIds.value.length > 1);

    const isValidLocale = (locale) => localeIds.value.includes(locale);
    const isActiveLocale = (locale) => activeLocales.value.includes(locale);
    const isCurrentLocale = (locale) => currentLocale.value === locale;

    const isTranslatable = (field) => translatableFields.value.includes(field);
    const changeLocale = (to) => {
        if (!isValidLocale(to)) {
            return;
        }

        currentLocale.value = to;
    };

    const nextLocale = () => {
        changeLocale(
            localeIds.value[localeIds.value.indexOf(props.locale) + 1] ||
                localeIds.value[0]
        );
    };

    return {
        locales,
        activeLocales,
        translatableFields,
        currentLocale,
        localeIds,
        hasLocale,
        isCurrentLocale,
        hasMultipleLocales,
        isValidLocale,
        isActiveLocale,
        isTranslatable,
        changeLocale,
        nextLocale,
    };
}
