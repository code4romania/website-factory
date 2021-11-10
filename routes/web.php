<?php

declare(strict_types=1);

use App\Http\Controllers\Front;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/decisions', [Front\DecisionController::class, 'index'])->name('decisions.index');
Route::get('/decisions/{decision:slug}', [Front\DecisionController::class, 'show'])->name('decisions.show');

Route::get('/blog', [Front\PostController::class, 'index'])->name('posts.index');
Route::get('/blog/{post:slug}', [Front\PostController::class, 'show'])->name('posts.show');

Route::get('/people', [Front\PersonController::class, 'index'])->name('people.index');
Route::get('/people/{person:slug}', [Front\PersonController::class, 'show'])->name('people.show');

Route::get('/', [Front\PageController::class, 'index'])->name('pages.index');
Route::get('/{page:slug}', [Front\PageController::class, 'show'])->name('pages.show');

Route::get('/forms/{form}', [Front\FormController::class, 'show'])->name('forms.show');
