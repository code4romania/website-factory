/** @type {import('tailwindcss').Config} */
module.exports = {
    theme: {
        container: {
            center: true,
            padding: {
                DEFAULT: '1rem',
                sm: '1.5rem',
                lg: '2rem',
            },
        },
        extend: {
            minWidth: (theme) => theme('spacing'),
            maxWidth: (theme) => theme('spacing'),
            minHeight: (theme) => theme('spacing'),
            maxHeight: (theme) => theme('spacing'),

            borderColor: {
                inherit: 'inherit',
            },
            typography: {
                DEFAULT: {
                    css: {
                        maxWidth: null,
                        '> ul > li > *:first-child': null,
                        '> ul > li > *:last-child': null,
                        '> ol > li > *:first-child': null,
                        '> ol > li > *:last-child': null,
                    },
                },
            },
        },
    },
    content: [
        'app/Services/Help.php',
        'help/**/*.md',
        'resources/views/admin/**/*.blade.php',
        'resources/js/**/*.vue',
        'resources/js/**/*.js',
    ],
    plugins: [
        require('@tailwindcss/aspect-ratio'),
        require('@tailwindcss/forms'),
        require('@tailwindcss/line-clamp'),
        require('@tailwindcss/typography'),
    ],
};
