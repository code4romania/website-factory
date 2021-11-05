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

Route::get('forms', [Admin\FormController::class, 'index'])->name('forms.index');
Route::get('forms/create', [Admin\FormController::class, 'create'])->name('forms.create');
Route::post('forms', [Admin\FormController::class, 'store'])->name('forms.store');
Route::get('forms/{form}/edit', [Admin\FormController::class, 'edit'])->name('forms.edit');
Route::post('forms/{form}/duplicate', [Admin\FormController::class, 'duplicate'])->name('forms.duplicate');
Route::post('forms/{form}/preview', [Admin\FormController::class, 'preview'])->name('forms.preview');
Route::put('forms/{form}', [Admin\FormController::class, 'update'])->name('forms.update');
Route::delete('forms/{form}', [Admin\FormController::class, 'destroy'])->name('forms.destroy');

Route::get('users', [Admin\UserController::class, 'index'])->name('users.index');
Route::get('users/create', [Admin\UserController::class, 'create'])->name('users.create');
Route::post('users', [Admin\UserController::class, 'store'])->name('users.store');
Route::get('users/{user}/edit', [Admin\UserController::class, 'edit'])->name('users.edit');
Route::put('users/{user}', [Admin\UserController::class, 'update'])->name('users.update');
Route::delete('users/{user}', [Admin\UserController::class, 'destroy'])->name('users.destroy');

Route::get('media', [Admin\MediaController::class, 'index'])->name('media.index');
Route::post('media', [Admin\MediaController::class, 'store'])->name('media.store');
Route::put('media/{media}', [Admin\MediaController::class, 'update'])->name('media.update');
Route::delete('media/{media}', [Admin\MediaController::class, 'destroy'])->name('media.destroy');
