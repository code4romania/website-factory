import { createApp, h } from 'vue';
import { createInertiaApp, Head, Link } from '@inertiajs/inertia-vue3';
import { ZiggyVue } from 'ziggy-js/dist/vue';

import registerComponents from '@/plugins/registerComponents';
import i18n from '@/plugins/i18n';

createInertiaApp({
    title: (title) => `${title} - Admin`,
    resolve: (name) => require(`@/pages/${name}`).default,
    setup({ el, app, props, plugin }) {
        createApp({ render: () => h(app, props) })
            .use(ZiggyVue)
            .use(plugin)
            .use(registerComponents)
            .use(i18n)
            .component('InertiaHead', Head)
            .component('InertiaLink', Link)
            .mount(el);
    },
});
