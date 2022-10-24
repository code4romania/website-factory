import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    resolve: {
        alias: {
            '@': '/resources/js',
            '~': '/resources',
            '%': '/lang',
        },
    },
    plugins: [
        laravel({
            valetTls: 'wf.test',
            input: [
                'resources/css/admin.css',
                'resources/js/admin.js',
                'resources/css/public.css',
                'resources/js/public.js',
            ],
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
});
