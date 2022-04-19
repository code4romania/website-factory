import { i18nVue } from 'laravel-vue-i18n';
import route from 'ziggy-js/src/js';
import axios from 'axios';

export default {
    install(Vue) {
        Vue.use(i18nVue, {
            resolve: (locale) =>
                new Promise((resolve) =>
                    axios
                        .get(route('admin.i18n', { locale }))
                        .then(({ data }) => resolve({ default: data }))
                ),
        });
    },
};
