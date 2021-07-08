const mix = require('laravel-mix');
const path = require('path');

class Translations {
    webpackRules() {
        return {
            test: path.resolve('resources/lang/index.js'),
            loader: '@kirschbaum-development/laravel-translations-loader',
            options: {
                parameters: '$1',
                includeOnly: [],
                exclude: [],
            },
        };
    }
}

mix.extend('translations', new Translations());
