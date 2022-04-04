const merge = require('lodash/merge');

module.exports = merge(require('../../tailwind.config.js'), {
    content: [
        'resources/views/admin/**/*.blade.php',
        'resources/js/**/*.vue',
        'resources/js/**/*.js',
    ],
});
