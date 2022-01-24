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
    Route::get('categories', [Admin\PostCategoryController::class, 'index'])->name('post_categories.index');
    Route::get('categories/create', [Admin\PostCategoryController::class, 'create'])->name('post_categories.create');
    Route::post('categories', [Admin\PostCategoryController::class, 'store'])->name('post_categories.store');
    Route::get('categories/{post_category}/edit', [Admin\PostCategoryController::class, 'edit'])->name('post_categories.edit');
    Route::post('categories/{post_category}/duplicate', [Admin\PostCategoryController::class, 'duplicate'])->name('post_categories.duplicate');
    Route::post('categories/{post_category}/preview', [Admin\PostCategoryController::class, 'preview'])->name('post_categories.preview');
    Route::put('categories/{post_category}', [Admin\PostCategoryController::class, 'update'])->name('post_categories.update');
    Route::delete('categories/{post_category}', [Admin\PostCategoryController::class, 'destroy'])->name('post_categories.destroy');
    Route::put('categories/{post_category}/restore', [Admin\PostCategoryController::class, 'restore'])->name('post_categories.restore')->withTrashed();
    Route::delete('categories/{post_category}/force', [Admin\PostCategoryController::class, 'forceDelete'])->name('post_categories.forceDelete')->withTrashed();

    Route::get('/', [Admin\PostController::class, 'index'])->name('posts.index');
    Route::get('create', [Admin\PostController::class, 'create'])->name('posts.create');
    Route::post('/', [Admin\PostController::class, 'store'])->name('posts.store');
    Route::get('{post}/edit', [Admin\PostController::class, 'edit'])->name('posts.edit');
    Route::post('{post}/duplicate', [Admin\PostController::class, 'duplicate'])->name('posts.duplicate');
    Route::post('{post}/preview', [Admin\PostController::class, 'preview'])->name('posts.preview');
    Route::put('{post}', [Admin\PostController::class, 'update'])->name('posts.update');
    Route::delete('{post}', [Admin\PostController::class, 'destroy'])->name('posts.destroy');
    Route::put('{post}/restore', [Admin\PostController::class, 'restore'])->name('posts.restore')->withTrashed();
    Route::delete('{post}/force', [Admin\PostController::class, 'forceDelete'])->name('posts.forceDelete')->withTrashed();
});

if (Features::hasDecisions()) {
    Route::group([
        'prefix'     => 'decisions',
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
}

Route::prefix('forms')->group(function () {
    Route::get('/', [Admin\FormController::class, 'index'])->name('forms.index');
    Route::get('create', [Admin\FormController::class, 'create'])->name('forms.create');
    Route::post('/', [Admin\FormController::class, 'store'])->name('forms.store');
    Route::get('{form}', [Admin\FormController::class, 'show'])->name('forms.show');
    Route::get('{form}/edit', [Admin\FormController::class, 'edit'])->name('forms.edit');
    Route::post('{form}/duplicate', [Admin\FormController::class, 'duplicate'])->name('forms.duplicate');
    Route::post('{form}/preview', [Admin\FormController::class, 'preview'])->name('forms.preview');
    Route::put('{form}', [Admin\FormController::class, 'update'])->name('forms.update');
    Route::delete('{form}', [Admin\FormController::class, 'destroy'])->name('forms.destroy');

    Route::get('{form}/submission/{form_submission}', [Admin\FormSubmissionController::class, 'show'])->name('form_submissions.show');
    Route::delete('{form}/submission/{form_submission}', [Admin\FormSubmissionController::class, 'destroy'])->name('form_submissions.destroy');
});

Route::group([
    'prefix'     => 'users',
    'as'         => 'users.',
    'controller' => Admin\UserController::class,
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
    'prefix'     => 'menus',
    'as'         => 'menus.',
    'controller' => Admin\MenuController::class,
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
], function () {
    Route::get('/', 'index')->name('index');
    Route::get('/{section}', 'edit')->name('edit');
    Route::post('/{section}', 'store')->name('store');
});
