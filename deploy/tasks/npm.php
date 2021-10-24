<?php

declare(strict_types=1);

namespace Deployer;

set('bin/npm', fn () => locateBinaryPath('npm'));

desc('Install npm packages');
task('npm:install', function () {
    if (test('[ -d node_modules ]')) {
        return;
    }

    run('{{bin/npm}} ci --prefer-offline');
})->local();

desc('Build frontend assets locally');
task('npm:build', function () {
    if (test('[ -d public/assets ]')) {
        return;
    }

    run('{{bin/npm}} run production');
})->local();

desc('Upload the assets to all hosts');
task('npm:upload', function () {
    upload('public/assets/', '{{release_path}}/public/assets/');
    upload('public/mix-manifest.json', '{{release_path}}/public/mix-manifest.json');
});
