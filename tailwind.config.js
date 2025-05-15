import aspectRatio from '@tailwindcss/aspect-ratio';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
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
            typography: (theme) => ({
                DEFAULT: {
                    css: {
                        maxWidth: null,
                        '> ul > li > *:first-child': null,
                        '> ul > li > *:last-child': null,
                        '> ol > li > *:first-child': null,
                        '> ol > li > *:last-child': null,

                        table: {
                            width: '100%',
                            marginTop: null,
                            marginBottom: null,
                            overflow: 'hidden',

                            'th, td': {
                                minWidth: '1em',
                                borderWidth: '2px',
                                borderStyle: 'solid',
                                borderColor: theme('colors.gray.200'),
                                padding: '0.5714286em',
                                position: 'relative',

                                '> *': {
                                    marginTop: 0,
                                    marginBottom: 0,
                                },
                            },
                            th: {
                                backgroundColor: theme('colors.gray.100'),
                                position: 'relative',
                            },
                        },

                        'thead th': {
                            paddingRight: null,
                            paddingBottom: null,
                            paddingLeft: null,
                        },
                        'thead th:first-child': {
                            paddingLeft: null,
                        },
                        'thead th:last-child': {
                            paddingRight: null,
                        },

                        'tbody td, tfoot td': {
                            paddingTop: null,
                            paddingRight: null,
                            paddingBottom: null,
                            paddingLeft: null,
                        },

                        'tbody td:first-child, tfoot td:first-child': {
                            paddingLeft: null,
                        },
                        'tbody td:last-child, tfoot td:last-child': {
                            paddingRight: null,
                        },
                    },
                },
            }),
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
        //
        aspectRatio,
        forms,
        typography,
    ],
};
