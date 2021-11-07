import isPlainObject from 'lodash/isPlainObject';
import { useForm } from '@inertiajs/inertia-vue3';
import { useLocale } from '@/helpers';

export default function (...args) {
    const { isTranslatable, locales } = useLocale();

    const rememberKey = typeof args[0] === 'string' ? args[0] : null;
    const model = (rememberKey ? args[2] : args[1]) || null;
    const fields = ((rememberKey ? args[1] : args[0]) || []).reduce(
        (fields, field) => {
            if (isTranslatable(field)) {
                fields[field] = locales.value.reduce(
                    (locales, locale) => ({
                        ...locales,
                        [locale]: isPlainObject(model)
                            ? model[field][locale] || null
                            : null,
                    }),
                    {}
                );
            } else {
                let fallback = ['blocks', 'media'].includes(field) ? [] : null;

                fields[field] = isPlainObject(model)
                    ? model[field] || fallback
                    : fallback;
            }

            return fields;
        },
        {}
    );

    if (!rememberKey) {
        return useForm(fields);
    }

    return useForm(
        isPlainObject(model) ? rememberKey + '.' + model.id : rememberKey,
        fields
    );
}
