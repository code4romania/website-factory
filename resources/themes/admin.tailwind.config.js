const merge = require('lodash/merge');

module.exports = merge(require('../../tailwind.config.js'), {
    content: [
        'app/Services/Help.php',
        'resources/views/admin/**/*.blade.php',
        'resources/help/**/*.md',
        'resources/js/**/*.vue',
        'resources/js/**/*.js',
    ],
});
