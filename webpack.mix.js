const mix = require('laravel-mix');
const path = require('path');

require('./mix/translations');

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
    //
}

mix.setPublicPath('public/assets')
    .setResourceRoot('./')
    .translations()
    .alias({
        '@': path.resolve('resources/js'),
        '~': path.resolve('resources'),
    })
    .js('resources/js/admin.js', 'public/assets')
    .vue({ version: 2 })
    .postCss('resources/css/app.css', 'public/assets', [
        require('postcss-100vh-fix'),
        require('tailwindcss'),
    ])
    .copyDirectory('resources/svg', 'public/assets/svg')
    .copyDirectory('resources/images', 'public/assets/images')
    .sourceMaps(false)
    .extract();
