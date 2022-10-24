const colorVariable = (variable) => {
    return ({ opacityVariable, opacityValue }) => {
        if (opacityValue !== undefined) {
            return `rgba(var(${variable}), ${opacityValue})`;
        }

        if (opacityVariable !== undefined) {
            return `rgba(var(${variable}), var(${opacityVariable}, 1))`;
        }

        return `rgb(var(${variable}))`;
    };
};

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
            colors: {
                primary: colorVariable('--color-primary'),
            },

            minWidth: (theme) => theme('spacing'),
            maxWidth: (theme) => theme('spacing'),
            minHeight: (theme) => theme('spacing'),
            maxHeight: (theme) => theme('spacing'),

            borderColor: {
                inherit: 'inherit',
            },

            typography: (theme) => ({
                DEFAULT: {
                    css: {
                        color: null,
                        maxWidth: null,
                        overflowX: 'auto',
                        overflowY: 'hidden',
                        '[class~="lead"]': {
                            color: null,
                        },
                        a: {
                            color: 'var(--tw-prose-links)',
                            textDecoration: 'underline',
                        },
                        'a:hover': {
                            textDecoration: 'none',
                        },
                        'a code': {
                            color: null,
                        },
                        strong: {
                            color: null,
                        },
                        'ol > li::marker': {
                            color: null,
                        },
                        'ul > li::marker': {
                            color: null,
                        },
                        '> ul > li > *:first-child': null,
                        '> ul > li > *:last-child': null,
                        '> ol > li > *:first-child': null,
                        '> ol > li > *:last-child': null,
                        hr: {
                            borderColor: 'var(--tw-prose-hr)',
                            borderTopWidth: 1,
                        },
                        blockquote: {
                            color: 'var(--tw-prose-quotes)',
                            borderLeftWidth: '0.25rem',
                            borderLeftColor: 'var(--tw-prose-quote-borders)',
                            quotes: '"\\201C""\\201D""\\2018""\\2019"',
                        },
                        h1: {
                            color: null,
                        },
                        h2: {
                            color: null,
                        },
                        h3: {
                            color: null,
                        },
                        h4: {
                            color: null,
                        },
                        figcaption: {
                            color: 'var(--tw-prose-captions)',
                        },
                        code: {
                            color: 'var(--tw-prose-code)',
                        },
                    },
                },
                primary: {
                    css: {
                        '--tw-prose-links': 'rgb(var(--color-primary))',
                    },
                },
            }),
        },
    },
    content: [
        'vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        'app/View/Components/**/*.php',
        'resources/views/**/*.blade.php',
    ],
    plugins: [
        require('@tailwindcss/aspect-ratio'),
        require('@tailwindcss/forms'),
        require('@tailwindcss/line-clamp'),
        require('@tailwindcss/typography'),
    ],
};
