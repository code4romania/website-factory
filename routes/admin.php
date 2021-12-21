<?php

declare(strict_types=1);

use App\Http\Controllers\Admin;
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

Route::get('pages', [Admin\PageController::class, 'index'])->name('pages.index');
Route::get('pages/create', [Admin\PageController::class, 'create'])->name('pages.create');
Route::post('pages', [Admin\PageController::class, 'store'])->name('pages.store');
Route::get('pages/{page}/edit', [Admin\PageController::class, 'edit'])->name('pages.edit');
Route::post('pages/{page}/duplicate', [Admin\PageController::class, 'duplicate'])->name('pages.duplicate');
Route::post('pages/{page}/preview', [Admin\PageController::class, 'preview'])->name('pages.preview');
Route::put('pages/{page}', [Admin\PageController::class, 'update'])->name('pages.update');
Route::delete('pages/{page}', [Admin\PageController::class, 'destroy'])->name('pages.destroy');
Route::put('pages/{page}/restore', [Admin\PageController::class, 'restore'])->name('pages.restore')->withTrashed();
Route::delete('pages/{page}/force', [Admin\PageController::class, 'forceDelete'])->name('pages.forceDelete')->withTrashed();

Route::get('people', [Admin\PersonController::class, 'index'])->name('people.index');
Route::get('people/create', [Admin\PersonController::class, 'create'])->name('people.create');
Route::post('people', [Admin\PersonController::class, 'store'])->name('people.store');
Route::get('people/{person}/edit', [Admin\PersonController::class, 'edit'])->name('people.edit');
Route::post('people/{person}/duplicate', [Admin\PersonController::class, 'duplicate'])->name('people.duplicate');
Route::post('people/{person}/preview', [Admin\PersonController::class, 'preview'])->name('people.preview');
Route::put('people/{person}', [Admin\PersonController::class, 'update'])->name('people.update');
Route::delete('people/{person}', [Admin\PersonController::class, 'destroy'])->name('people.destroy');
Route::put('people/{person}/restore', [Admin\PersonController::class, 'restore'])->name('people.restore')->withTrashed();
Route::delete('people/{person}/force', [Admin\PersonController::class, 'forceDelete'])->name('people.forceDelete')->withTrashed();

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

Route::get('decisions', [Admin\DecisionController::class, 'index'])->name('decisions.index');
Route::get('decisions/create', [Admin\DecisionController::class, 'create'])->name('decisions.create');
Route::post('decisions', [Admin\DecisionController::class, 'store'])->name('decisions.store');
Route::get('decisions/{decision}/edit', [Admin\DecisionController::class, 'edit'])->name('decisions.edit');
Route::post('decisions/{decision}/duplicate', [Admin\DecisionController::class, 'duplicate'])->name('decisions.duplicate');
Route::post('decisions/{decision}/preview', [Admin\DecisionController::class, 'preview'])->name('decisions.preview');
Route::put('decisions/{decision}', [Admin\DecisionController::class, 'update'])->name('decisions.update');
Route::delete('decisions/{decision}', [Admin\DecisionController::class, 'destroy'])->name('decisions.destroy');
Route::put('decisions/{decision}/restore', [Admin\DecisionController::class, 'restore'])->name('decisions.restore')->withTrashed();
Route::delete('decisions/{decision}/force', [Admin\DecisionController::class, 'forceDelete'])->name('decisions.forceDelete')->withTrashed();

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

Route::get('users', [Admin\UserController::class, 'index'])->name('users.index');
Route::get('users/create', [Admin\UserController::class, 'create'])->name('users.create');
Route::post('users', [Admin\UserController::class, 'store'])->name('users.store');
Route::get('users/{user}/edit', [Admin\UserController::class, 'edit'])->name('users.edit');
Route::put('users/{user}', [Admin\UserController::class, 'update'])->name('users.update');
Route::delete('users/{user}', [Admin\UserController::class, 'destroy'])->name('users.destroy');

Route::get('media/images', [Admin\MediaController::class, 'images'])->name('media.images');
Route::get('media/files', [Admin\MediaController::class, 'files'])->name('media.files');
Route::post('media', [Admin\MediaController::class, 'store'])->name('media.store');
Route::put('media/{media}', [Admin\MediaController::class, 'update'])->name('media.update');
Route::delete('media/{media}', [Admin\MediaController::class, 'destroy'])->name('media.destroy');

Route::where(['location' => '(header|footer)'])->group(function () {
    Route::get('menus', [Admin\MenuController::class, 'index'])->name('menus.index');
    Route::get('menus/{location}', [Admin\MenuController::class, 'edit'])->name('menus.edit');
    Route::post('menus/{location}', [Admin\MenuController::class, 'update'])->name('menus.update');
});

Route::get('settings', [Admin\SettingController::class, 'index'])->name('settings.index');
Route::post('settings', [Admin\SettingController::class, 'store'])->name('settings.store');
