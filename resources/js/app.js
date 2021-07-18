import { createApp, h } from 'vue';
import { createInertiaApp, Head, Link } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';

import i18n from '@/plugins/i18n';
import registerComponents from '@/plugins/registerComponents';

const el = document.getElementById('app');

createInertiaApp({
    resolve: (name) => require(`@/pages/${name}`).default,
    setup({ el, app, props, plugin }) {
        createApp({ render: () => h(app, props) })
            .mixin({ methods: { route } })
            .use(plugin)
            .use(registerComponents)
            .use(i18n)
            .component('InertiaHead', Head)
            .component('InertiaLink', Link)
            .mount(el);
    },
});

InertiaProgress.init({ color: '#4B5563' });
