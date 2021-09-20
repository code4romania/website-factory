const colors = require('tailwindcss/colors');

module.exports = {
    mode: 'jit',
    darkMode: 'class',
    theme: {
        extend: {
            colors: colors,
            fontFamily: {
                sans: [
                    'ui-sans-serif',
                    'system-ui',
                    '-apple-system',
                    'BlinkMacSystemFont',
                    '"Segoe UI"',
                    'Roboto',
                    '"Helvetica Neue"',
                    'Arial',
                    '"Noto Sans"',
                    'sans-serif',
                    '"Apple Color Emoji"',
                    '"Segoe UI Emoji"',
                    '"Segoe UI Symbol"',
                    '"Noto Color Emoji"',
                ],
                serif: [
                    'ui-serif',
                    'Georgia',
                    'Cambria',
                    '"Times New Roman"',
                    'Times',
                    'serif',
                ],
            },

            minWidth: (theme) => theme('spacing'),
            maxWidth: (theme) => theme('spacing'),
            minHeight: (theme) => theme('spacing'),
            maxHeight: (theme) => theme('spacing'),

            borderColor: (theme) => ({
                inherit: 'inherit',
            }),
        },
    },
    variants: {
        extend: {
            //
        },
    },
    corePlugins: {
        container: false,
    },
    plugins: [
        require('@tailwindcss/aspect-ratio'),
        require('@tailwindcss/forms'),
        require('@tailwindcss/line-clamp'),
        require('@tailwindcss/typography'),
    ],
    purge: {
        content: [
            //
            'vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
            'resources/views/**/*.blade.php',
            'resources/js/**/*.vue',
            'resources/js/**/*.js',
        ],
        options: {
            safelist: [
                //
            ],
        },
    },
};
