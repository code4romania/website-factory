const mix = require('laravel-mix');
const path = require('path');

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
} else {
    // require('laravel-mix-bundle-analyzer');
    // mix.bundleAnalyzer({ openAnalyzer: false });
}

mix.valet('primarie.test')
    .alias({
        '@': path.resolve('resources/js'),
        '~': path.resolve('resources'),
    })
    .js('resources/js/public.js', 'public/assets')
    .js('resources/js/app.js', 'public/assets')
    .vue({ version: 3 })
    .postCss('resources/css/app.css', 'public/assets', [
        require('postcss-100vh-fix'),
        require('postcss-import'),
        require('tailwindcss'),
        require('autoprefixer'),
    ])
    .copyDirectory('resources/svg', 'public/assets/svg')
    .copyDirectory('resources/images', 'public/assets/images')
    .sourceMaps(false)
    .extract()
    .extract(['alpinejs'], 'public/assets/public.vendor.js')

    .override((config) => {
        config.module.rules.push({
            test: path.resolve('resources/lang/index.js'),
            loader: '@kirschbaum-development/laravel-translations-loader/php',
            options: {
                parameters: '{$1}',
                exclude: [
                    //
                    'validation',
                ],
            },
        });

        const initialSvgRule = config.module.rules.find((rule) =>
            rule.test.test('.svg')
        );

        initialSvgRule.test = /\.(png|jpe?g|gif|webp)$/;

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
    })

    .webpackConfig((webpack) => ({
        plugins: [
            new webpack.DefinePlugin({
                __VUE_OPTIONS_API__: true,
                __VUE_PROD_DEVTOOLS__: false,
            }),
        ],
    }));
