<?php

declare(strict_types=1);

namespace Deployer;

set('bin/npm', fn () => locateBinaryPath('npm'));

desc('Install npm packages');
task('npm:install', function () {
    if (testLocally('[ -d node_modules ]')) {
        return;
    }

    runLocally('{{bin/npm}} ci --prefer-offline');
});

desc('Build frontend assets locally');
task('npm:build', function () {
    if (testLocally('[ -d public/assets ]')) {
        return;
    }

    runLocally('{{bin/npm}} run production');
});

desc('Upload the assets to all hosts');
task('npm:upload', function () {
    upload('public/assets/', '{{release_path}}/public/assets/');
    upload('public/mix-manifest.json', '{{release_path}}/public/mix-manifest.json');
});
