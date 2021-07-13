import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';

import registerComponents from '@/plugins/registerComponents';

import AuthenticatedLayout from '@/layouts/Authenticated';
import GuestLayout from '@/layouts/Guest';

const el = document.getElementById('app');

createInertiaApp({
    resolve: (name) => {
        const page = require(`@/Pages/${name}`).default;

        if (!page.layout) {
            page.layout = name.startsWith('Auth/')
                ? GuestLayout
                : AuthenticatedLayout;
        }

        return page;
    },
    setup({ el, app, props, plugin }) {
        createApp({ render: () => h(app, props) })
            .mixin({ methods: { route } })
            .use(plugin)
            .use(registerComponents)
            .mount(el);
    },
});

InertiaProgress.init({ color: '#4B5563' });
