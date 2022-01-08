const merge = require('lodash/merge');

module.exports = merge(
    require('./common.tailwind.config.js'),
    {
        content: [
            'vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
            'app/View/Components/**/*.php',
            'resources/views/**/*.blade.php',
        ],
    }
);
