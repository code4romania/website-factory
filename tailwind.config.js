module.exports = {
    theme: {
        extend: {
            minWidth: (theme) => theme('spacing'),
            maxWidth: (theme) => theme('spacing'),
            minHeight: (theme) => theme('spacing'),
            maxHeight: (theme) => theme('spacing'),

            borderColor: (theme) => ({
                inherit: 'inherit',
            }),
            typography: (theme) => ({
                DEFAULT: {
                    css: {
                        color: theme('colors.gray.900'),
                        maxWidth: null,
                        '> ul > li > *:first-child': null,
                        '> ul > li > *:last-child': null,
                        '> ol > li > *:first-child': null,
                        '> ol > li > *:last-child': null,
                    },
                },
            }),
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
    content: [
        'vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        'app/View/Components/**/*.php',
        'resources/views/**/*.blade.php',
        'resources/js/**/*.vue',
        'resources/js/**/*.js',
    ],
};
