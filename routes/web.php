<?php

declare(strict_types=1);

use App\Http\Controllers\Front;
use App\Http\Middleware\VerifyCsrfToken;
use App\Services\Features;
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

Route::get('/theme/style.css', Front\ThemeController::class)->name('theme')
    ->withoutMiddleware('web')
    ->middleware('cache.headers:public;max_age=2628000;etag');

Route::prefix('{locale?}')->group(function () {
    if (Features::hasDecisions()) {
        Route::get('/decisions', [Front\DecisionController::class, 'index'])->name('decisions.index');
        Route::get('/decisions/{decision:slug}', [Front\DecisionController::class, 'show'])->name('decisions.show');
    }

    if (Features::hasDonations()) {
        Route::post('/donate', [Front\DonationController::class, 'submit'])->name('donations.submit');
        Route::get('/donate/return', [Front\DonationController::class, 'return'])->name('donations.return');
        // Route::post('/donate/webhook', [Front\DonationController::class, 'webhook'])->name('donations.webhook')
        //     ->withoutMiddleware(VerifyCsrfToken::class);
    }

    Route::get('/blog', [Front\PostController::class, 'index'])->name('posts.index');
    Route::get('/blog/category', [Front\PostCategoryController::class, 'index'])->name('post_categories.index');
    Route::get('/blog/category/{post_category:slug}', [Front\PostCategoryController::class, 'show'])->name('post_categories.show');
    Route::get('/blog/{post:slug}', [Front\PostController::class, 'show'])->name('posts.show');

    Route::get('/people', [Front\PersonController::class, 'index'])->name('people.index');
    Route::get('/people/{person:slug}', [Front\PersonController::class, 'show'])->name('people.show');

    Route::get('/forms/{form:uuid}', [Front\FormController::class, 'show'])->name('forms.show');
    Route::post('/forms/{form:uuid}', [Front\FormController::class, 'submit'])->name('forms.submit');

    Route::get('/', [Front\PageController::class, 'index'])->name('pages.index');
    Route::get('/{page:slug}', [Front\PageController::class, 'show'])->name('pages.show');
});
