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

Route::get('/', [Front\PageController::class, 'index'])->name('home');
Route::get('/{page:slug}', [Front\PageController::class, 'show'])->name('pages.show');

Route::get('/forms/{form}', [Front\FormController::class, 'show'])->name('forms.show');
