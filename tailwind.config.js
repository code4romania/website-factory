const colors = require('tailwindcss/colors');

module.exports = {
    mode: 'jit',
    darkMode: 'class',
    theme: {
        colors: {
            //
        },
        extend: {
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
        },
    },
    variants: {
        extend: {
            //
        },
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
