const mix = require('laravel-mix');
const path = require('path');
const tailwindcss = require('tailwindcss');

require('laravel-mix-valet');
require('laravel-mix-bundle-analyzer');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

if (mix.inProduction()) {
    mix.version();
}

mix.valet()
    .alias({
        '@': path.resolve('resources/js'),
        '~': path.resolve('resources'),
    })
    .js('resources/js/public.js', 'public/assets')
    .js('resources/js/admin.js', 'public/assets')
    .vue({ version: 3 })

    .postCss('resources/css/admin.css', 'admin.css', [
        tailwindcss('resources/themes/admin.tailwind.config.js'),
        require('postcss-100vh-fix'),
    ])

    .postCss('resources/css/public.css', 'public.css', [
        tailwindcss('resources/themes/public.tailwind.config.js'),
        require('postcss-100vh-fix'),
    ])

    .setPublicPath('public/assets')
    .sourceMaps(false)

    .override((config) => {
        const imageRule = config.module.rules.find((rule) =>
            rule.test.test('.svg')
        );

        imageRule.test = /\.(png|jpe?g|gif|webp)$/;

        const fontRule = config.module.rules.find((rule) =>
            rule.test.test('font.*.svg')
        );

        fontRule.test = /\.(woff2?|ttf|eot|otf)$/;

        config.module.rules.push({
            test: /\.svg$/,
            use: [
                'raw-loader',
                {
                    loader: 'vue-svg-loader',
                    options: {
                        svgo: {
                            plugins: [
                                { removeDimensions: true },
                                { removeViewBox: false },
                                { removeXMLNS: true },
                                {
                                    removeUselessStrokeAndFill: {
                                        fill: true,
                                        stroke: true,
                                        removeNone: true,
                                    },
                                },
                            ],
                        },
                    },
                },
            ],
        });
    });
