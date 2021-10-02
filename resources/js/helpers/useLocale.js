import { usePage } from '@inertiajs/inertia-vue3';
import { computed } from 'vue';

export default function (props) {
    const locales = computed(() => usePage().props.value.locales.available || []);
    const translatableFields = computed(() => usePage().props.value.model.translatable || []);
    const currentLocale = computed({
        get: () => usePage().props.value.locales.current,
        set: (locale) => (usePage().props.value.locales.current = locale),
    });

    const hasLocale = computed(() => props.locale !== null);
    const isCurrentLocale = computed(() => (hasLocale.value ? props.locale === currentLocale.value : true));

    const isValidLocale = (locale) => locales.value.includes(locale);
    const isTranslatable = (field) => translatableFields.value.includes(field);
    const changeLocale = (to) => {
        if (!isValidLocale(to)) {
            return;
        }

        currentLocale.value = to;
    };

    const nextLocale = () => {
        changeLocale(locales.value[locales.value.indexOf(props.locale) + 1] || locales.value[0]);
    };

    return {
        locales,
        translatableFields,
        currentLocale,
        hasLocale,
        isCurrentLocale,
        isValidLocale,
        isTranslatable,
        changeLocale,
        nextLocale,
    };
}
