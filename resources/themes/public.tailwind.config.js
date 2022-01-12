const merge = require('lodash/merge');

const colorVariable = (variable) => {
    return ({ opacityVariable, opacityValue }) => {
        if (opacityValue !== undefined) {
            return `rgba(var(${variable}), ${opacityValue})`;
        }

        if (opacityVariable !== undefined) {
            return `rgba(var(${variable}), var(${opacityVariable}, 1))`;
        }

        return `rgb(var(${variable}))`;
    }
}

module.exports = merge(
    require('../../tailwind.config.js'),
    {
        theme: {
            extend: {
                colors: {
                    primary: colorVariable('--color-primary'),
                },
                typography: (theme)=> ({
                    //
                })
            },
        },
        content: [
            'vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
            'app/View/Components/**/*.php',
            'resources/views/**/*.blade.php',
        ],
    }
);
