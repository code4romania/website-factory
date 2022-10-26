<?php

declare(strict_types=1);

use App\Http\Controllers\Admin;
use App\Services\Features;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" and "admin" middleware groups. Now create something great!
|
*/

Route::get('/', Admin\DashboardController::class)->name('dashboard');

Route::get('/search', Admin\SearchController::class)->name('search');

Route::get('/i18n/{locale}.json', [Admin\LanguageController::class, 'lines'])
    ->withoutMiddleware(['auth', 'web'])
    ->middleware('cache.headers:public;max_age=2628000;etag')
    ->name('i18n');

Route::group([
    'prefix'     => 'pages',
    'as'         => 'pages.',
    'controller' => Admin\PageController::class,
], function () {
    Route::get('/', 'index')->name('index');
    Route::get('/create', 'create')->name('create');
    Route::post('/', 'store')->name('store');
    Route::get('/{page}/edit', 'edit')->name('edit');
    Route::post('/{page}/duplicate', 'duplicate')->name('duplicate');
    Route::post('/{page}/preview', 'preview')->name('preview');
    Route::put('/{page}', 'update')->name('update');
    Route::delete('/{page}', 'destroy')->name('destroy');
    Route::put('/{page}/restore', 'restore')->name('restore')->withTrashed();
    Route::delete('/{page}/force', 'forceDelete')->name('forceDelete')->withTrashed();
});

Route::group([
    'prefix'     => 'people',
    'as'         => 'people.',
    'controller' => Admin\PersonController::class,
], function () {
    Route::get('/', 'index')->name('index');
    Route::get('/create', 'create')->name('create');
    Route::post('/', 'store')->name('store');
    Route::get('/collection', 'collection')->name('collection');
    Route::get('/{person}/edit', 'edit')->name('edit');
    Route::post('/{person}/duplicate', 'duplicate')->name('duplicate');
    Route::post('/{person}/preview', 'preview')->name('preview');
    Route::put('/{person}', 'update')->name('update');
    Route::delete('/{person}', 'destroy')->name('destroy');
    Route::put('/{person}/restore', 'restore')->name('restore')->withTrashed();
    Route::delete('/{person}/force', 'forceDelete')->name('forceDelete')->withTrashed();
});

Route::prefix('posts')->group(function () {
    Route::group([
        'prefix'     => 'categories',
        'as'         => 'post_categories.',
        'controller' => Admin\PostCategoryController::class,
    ], function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{post_category}/edit', 'edit')->name('edit');
        Route::post('/{post_category}/duplicate', 'duplicate')->name('duplicate');
        Route::post('/{post_category}/preview', 'preview')->name('preview');
        Route::put('/{post_category}', 'update')->name('update');
        Route::delete('/{post_category}', 'destroy')->name('destroy');
        Route::put('/{post_category}/restore', 'restore')->name('restore')->withTrashed();
        Route::delete('/{post_category}/force', 'forceDelete')->name('forceDelete')->withTrashed();
    });

    Route::group([
        'as'         => 'posts.',
        'controller' => Admin\PostController::class,
    ], function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{post}/edit', 'edit')->name('edit');
        Route::post('/{post}/duplicate', 'duplicate')->name('duplicate');
        Route::post('/{post}/preview', 'preview')->name('preview');
        Route::put('/{post}', 'update')->name('update');
        Route::delete('/{post}', 'destroy')->name('destroy');
        Route::put('/{post}/restore', 'restore')->name('restore')->withTrashed();
        Route::delete('/{post}/force', 'forceDelete')->name('forceDelete')->withTrashed();
    });
});

if (Features::hasDecisions()) {
    Route::prefix('decisions')->group(function () {
        Route::group([
            'prefix'     => 'categories',
            'as'         => 'decision_categories.',
            'controller' => Admin\DecisionCategoryController::class,
        ], function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('/{decision_category}/edit', 'edit')->name('edit');
            Route::post('/{decision_category}/duplicate', 'duplicate')->name('duplicate');
            Route::post('/{decision_category}/preview', 'preview')->name('preview');
            Route::put('/{decision_category}', 'update')->name('update');
            Route::delete('/{decision_category}', 'destroy')->name('destroy');
            Route::put('/{decision_category}/restore', 'restore')->name('restore')->withTrashed();
            Route::delete('/{decision_category}/force', 'forceDelete')->name('forceDelete')->withTrashed();
        });

        Route::group([
            'prefix'     => 'authors',
            'as'         => 'decision_authors.',
            'controller' => Admin\DecisionAuthorController::class,
        ], function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('/{decision_author}/edit', 'edit')->name('edit');
            Route::post('/{decision_author}/duplicate', 'duplicate')->name('duplicate');
            Route::post('/{decision_author}/preview', 'preview')->name('preview');
            Route::put('/{decision_author}', 'update')->name('update');
            Route::delete('/{decision_author}', 'destroy')->name('destroy');
            Route::put('/{decision_author}/restore', 'restore')->name('restore')->withTrashed();
            Route::delete('/{decision_author}/force', 'forceDelete')->name('forceDelete')->withTrashed();
        });

        Route::group([
            'as'         => 'decisions.',
            'controller' => Admin\DecisionController::class,
        ], function () {
            Route::get('/', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('{decision}/edit', 'edit')->name('edit');
            Route::post('{decision}/duplicate', 'duplicate')->name('duplicate');
            Route::post('{decision}/preview', 'preview')->name('preview');
            Route::put('{decision}', 'update')->name('update');
            Route::delete('{decision}', 'destroy')->name('destroy');
            Route::put('{decision}/restore', 'restore')->name('restore')->withTrashed();
            Route::delete('{decision}/force', 'forceDelete')->name('forceDelete')->withTrashed();
        });
    });
}

Route::group([
    'prefix'     => 'forms',
    'as'         => 'forms.',
    'controller' => Admin\FormController::class,
], function () {
    Route::get('/', 'index')->name('index');
    Route::get('/create', 'create')->name('create');
    Route::post('/', 'store')->name('store');
    Route::get('/collection', 'collection')->name('collection');
    Route::get('/{form}', 'show')->name('show');
    Route::get('/{form}/edit', 'edit')->name('edit');
    Route::post('/{form}/duplicate', 'duplicate')->name('duplicate');
    Route::post('/{form}/preview', 'preview')->name('preview');
    Route::put('/{form}', 'update')->name('update');
    Route::delete('/{form}', 'destroy')->name('destroy');
    Route::put('{form}/restore', 'restore')->name('restore')->withTrashed();
    Route::delete('{form}/force', 'forceDelete')->name('forceDelete')->withTrashed();
});

Route::group([
    'as'         => 'form_submissions.',
    'controller' => Admin\FormSubmissionController::class,
], function () {
    Route::get('form_submission/{form_submission}', 'show')->name('show');
    Route::delete('form_submission/{form_submission}', 'destroy')->name('destroy');
});

Route::group([
    'prefix'     => 'users',
    'as'         => 'users.',
    'controller' => Admin\UserController::class,
    'middleware' => 'role:admin',
], function () {
    Route::get('/', 'index')->name('index');
    Route::get('/create', 'create')->name('create');
    Route::post('/', 'store')->name('store');
    Route::get('/{user}/edit', 'edit')->name('edit');
    Route::put('/{user}', 'update')->name('update');
    Route::delete('/{user}', 'destroy')->name('destroy');
});

Route::group([
    'prefix'     => 'media',
    'as'         => 'media.',
    'controller' => Admin\MediaController::class,
], function () {
    Route::get('/images', 'images')->name('images');
    Route::get('/files', 'files')->name('files');
    Route::post('/', 'store')->name('store');
    Route::put('/{media}', 'update')->name('update');
    Route::delete('/{media}', 'destroy')->name('destroy');
});

Route::group([
    'prefix'     => 'partners',
    'as'         => 'partners.',
    'controller' => Admin\PartnerController::class,
    'middleware' => 'role:admin',
], function () {
    Route::get('/', 'index')->name('index');
    Route::get('/create', 'create')->name('create');
    Route::post('/', 'store')->name('store');
    Route::get('/{partner}/edit', 'edit')->name('edit');
    Route::post('/{partner}/duplicate', 'duplicate')->name('duplicate');
    Route::post('/{partner}/preview', 'preview')->name('preview');
    Route::put('/{partner}', 'update')->name('update');
    Route::delete('/{partner}', 'destroy')->name('destroy');
    Route::put('/{partner}/restore', 'restore')->name('restore')->withTrashed();
    Route::delete('/{partner}/force', 'forceDelete')->name('forceDelete')->withTrashed();
});

Route::group([
    'prefix'     => 'menus',
    'as'         => 'menus.',
    'controller' => Admin\MenuController::class,
    'middleware' => 'role:admin',
    'where'      => ['location' => '(header|footer)'],
], function () {
    Route::get('/', 'index')->name('index');
    Route::get('/{location}', 'edit')->name('edit');
    Route::post('/{location}', 'update')->name('update');
});

Route::group([
    'prefix'     => 'settings',
    'as'         => 'settings.',
    'controller' => Admin\SettingController::class,
    'middleware' => 'role:admin',
], function () {
    Route::get('/', 'index')->name('index');
    Route::get('/{section}', 'edit')->name('edit');
    Route::post('/{section}', 'store')->name('store');
});

Route::group([
    'prefix'     => 'languages',
    'as'         => 'languages.',
    'controller' => Admin\LanguageController::class,
    'middleware' => 'role:admin',
], function () {
    Route::get('/', 'index')->name('index');
    Route::get('/create', 'create')->name('create');
    Route::post('/', 'store')->name('store');
    Route::get('/{language}/edit', 'edit')->name('edit');
    Route::put('/{language}', 'update')->name('update');
    Route::delete('/{language}', 'destroy')->name('destroy');
});

Route::get('/help', Admin\HelpController::class)->name('help');
