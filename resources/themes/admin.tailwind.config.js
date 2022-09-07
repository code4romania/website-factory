const merge = require('lodash/merge');

module.exports = merge(require('../../tailwind.config.js'), {
    content: [
        'app/Services/Help.php',
        'help/**/*.md',
        'resources/views/admin/**/*.blade.php',
        'resources/js/**/*.vue',
        'resources/js/**/*.js',
    ],
});
