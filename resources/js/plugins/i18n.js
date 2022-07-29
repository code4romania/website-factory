import { i18nVue } from 'laravel-vue-i18n';
import { route } from '@/helpers';
import axios from 'axios';

/**
 * Translation loading order, aiming to minimize the impact of
 * missing translations or configuration errors:
 *
 *   1. attempt to get translations from the database.
 *   2. attempt to import ${locale}.json from source code.
 *   3. fallback to ro.json
 *
 */
const loadTranslations = (locale) => {
    return new Promise((resolve) => {
        axios
            .get(route('admin.i18n', { locale }))
            .then(({ data }) => resolve({ default: data }))
            .catch(() =>
                import(`%/${locale}.json`)
                    .then((data) => resolve({ default: data }))
                    .catch(() => resolve({ default: import('%/ro.json') }))
            );
    });
};

export default {
    install(Vue) {
        Vue.use(i18nVue, {
            resolve: loadTranslations,
        });
    },
};
