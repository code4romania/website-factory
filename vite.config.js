import { defineConfig, loadEnv } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import manifestSRI from 'vite-plugin-manifest-sri';
import { createSvgIconsPlugin } from 'vite-plugin-svg-icons';
import path from 'path';

export default defineConfig(({ mode }) => {
    const env = loadEnv(mode, import.meta.dirname);

    return {
        plugins: [
            laravel({
                refresh: true,
                detectTls: env.VITE_DETECT_TLS || null,
                input: [
                    'resources/css/admin.css',
                    'resources/js/admin.js',
                    'resources/css/public.css',
                    'resources/js/public.js',
                ],
            }),
            manifestSRI(),
            vue({
                template: {
                    transformAssetUrls: {
                        base: null,
                        includeAbsolute: false,
                    },
                },
            }),
            createSvgIconsPlugin({
                iconDirs: [
                    path.resolve(process.cwd(), 'node_modules/remixicon/icons'),
                    path.resolve(process.cwd(), 'resources/svg'),
                ],
                symbolId: 'icon-[name]',
            }),
        ],
        resolve: {
            alias: {
                '@': '/resources/js',
                '~': '/resources',
                '%': '/lang',
            },
        }
    };
});
