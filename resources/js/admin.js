import { createApp, h } from 'vue';
import { createInertiaApp, Head, Link } from '@inertiajs/inertia-vue3';
import { ZiggyVue } from 'ziggy-js/dist/vue';
import mitt from 'mitt';
import VueClickAway from 'vue3-click-away';

import registerComponents from '@/plugins/registerComponents';
import progress from '@/plugins/progress';
import i18n from '@/plugins/i18n';

import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import 'virtual:svg-icons-register';

createInertiaApp({
    title: (title) => `${title} - Admin`,
    resolve: (name) =>
        resolvePageComponent(
            `./pages/${name}.vue`,
            import.meta.globEager('./pages/**/*.vue')
        ),
    setup({ el, app, props, plugin }) {
        createApp({ render: () => h(app, props) })
            .use(ZiggyVue)
            .use(i18n)
            .use(plugin)
            .use(registerComponents)
            .use(progress)
            .use(VueClickAway)
            .component('InertiaHead', Head)
            .component('InertiaLink', Link)
            .provide('bus', mitt())
            .mount(el);
    },
});
