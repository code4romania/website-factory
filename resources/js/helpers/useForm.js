import isPlainObject from 'lodash/isPlainObject';
import { useForm } from '@inertiajs/vue3';
import { defaultValue, useLocale } from '@/helpers';

export default function (rememberKey, model, fields, fieldTypes = {}) {
    const { isTranslatable, localeIds } = useLocale();

    fieldTypes = {
        blocks: Array,
        media: Array,
        ...fieldTypes,
    };

    return useForm(
        isPlainObject(model) ? rememberKey + '.' + model.id : rememberKey,
        fields.reduce((fields, field) => {
            if (isTranslatable(field)) {
                fields[field] = localeIds.value.reduce(
                    (locales, locale) => ({
                        ...locales,
                        [locale]: isPlainObject(model)
                            ? model[field][locale] || null
                            : null,
                    }),
                    {}
                );
            } else {
                const fallback = fieldTypes.hasOwnProperty(field)
                    ? defaultValue(fieldTypes[field])
                    : null;

                fields[field] = isPlainObject(model)
                    ? model[field] || fallback
                    : fallback;
            }

            return fields;
        }, {})
    );
}
