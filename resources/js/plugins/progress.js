import { InertiaProgress } from '@inertiajs/progress';

export default {
    install(Vue) {
        InertiaProgress.init({
            // The delay after which the progress bar will
            // appear during navigation, in milliseconds.
            delay: 250,

            // The color of the progress bar.
            color: '#3B82F6',

            // Whether to include the default NProgress styles.
            includeCSS: true,

            // Whether the NProgress spinner will be shown.
            showSpinner: true,
        });
    },
};
