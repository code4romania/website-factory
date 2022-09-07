const mix = require('laravel-mix');
const path = require('path');
const tailwindcss = require('tailwindcss');

require('laravel-mix-valet');

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
        '%': path.resolve('lang'),
    })
    .js('resources/js/public.js', 'public/assets')
    .js('resources/js/admin.js', 'public/assets')
    .vue({ version: 3 })

    .postCss('resources/css/admin.css', 'public/assets/admin.css', [
        tailwindcss('resources/themes/admin.tailwind.config.js'),
        require('postcss-100vh-fix'),
    ])

    .postCss('resources/css/public.css', 'public/assets/public.css', [
        tailwindcss('resources/themes/public.tailwind.config.js'),
        require('postcss-100vh-fix'),
    ])

    .copyDirectory('resources/images', 'public/assets/images')
    .copyDirectory('help/images', 'public/assets/help')

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
                    loader: 'svgo-loader',
                    options: {
                        multipass: true,
                        plugins: [
                            {
                                name: 'preset-default',
                                params: {
                                    overrides: {
                                        removeViewbox: false,
                                        removeUselessStrokeAndFill: {
                                            fill: true,
                                            stroke: true,
                                            removeNone: true,
                                        },
                                    },
                                },
                            },
                            { name: 'removeDimensions' },
                            { name: 'removeXMLNS' },
                        ],
                    },
                },
                'vue-svg-component-loader',
            ],
        });
    });
