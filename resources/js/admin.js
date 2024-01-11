import { createApp, h } from 'vue';
import { createInertiaApp, Head, Link } from '@inertiajs/vue3';
import { ZiggyVue } from 'ziggy-js/dist/vue';
import mitt from 'mitt';
import VueClickAway from 'vue3-click-away';

import registerComponents from '@/plugins/registerComponents';
import i18n from '@/plugins/i18n';

import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import 'virtual:svg-icons-register';

createInertiaApp({
    title: (title) => `${title} - Admin`,
    resolve: (name) =>
        resolvePageComponent(
            `./pages/${name}.vue`,
            import.meta.glob('./pages/**/*.vue', { eager: true })
        ),
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(ZiggyVue)
            .use(i18n)
            .use(plugin)
            .use(registerComponents)
            .use(VueClickAway)
            .component('InertiaHead', Head)
            .component('InertiaLink', Link)
            .provide('bus', mitt())
            .mount(el);
    },
    progress: {
        delay: 250,
        color: '#3B82F6',
        includeCSS: true,
        showSpinner: true,
    },
});
