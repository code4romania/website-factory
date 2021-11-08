import isPlainObject from 'lodash/isPlainObject';
import { useForm } from '@inertiajs/inertia-vue3';
import { useLocale } from '@/helpers';

export default function (rememberKey, model, fields) {
    const { isTranslatable, locales } = useLocale();

    return useForm(
        isPlainObject(model) ? rememberKey + '.' + model.id : rememberKey,
        fields.reduce((fields, field) => {
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
        }, {})
    );
}
