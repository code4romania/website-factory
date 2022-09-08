<?php

declare(strict_types=1);

use App\Http\Controllers\Front;
use App\Http\Middleware\Front\SetLocale;
use App\Http\Middleware\Front\SetSeoDefaults;
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

Route::withoutMiddleware([SetLocale::class, SetSeoDefaults::class])->group(function () {
    Route::get('/theme/style.css', Front\ThemeController::class)->name('theme');
    Route::get('/health', Front\HealthCheckController::class)->name('health');
});

Route::prefix('{locale?}')->group(function () {
    if (Features::hasDecisions()) {
        Route::get('/decisions', [Front\DecisionController::class, 'index'])->name('decisions.index');
        Route::get('/decisions/category', [Front\DecisionCategoryController::class, 'index'])->name('decision_categories.index');
        Route::get('/decisions/category/{decision_category:slug}', [Front\DecisionCategoryController::class, 'show'])->name('decision_categories.show');
        Route::get('/decisions/{decision:slug}', [Front\DecisionController::class, 'show'])->name('decisions.show');
    }

    if (Features::hasDonations()) {
        Route::post('/donate', [Front\DonationController::class, 'submit'])->name('donations.submit')->middleware('throttle:donations');

        Route::match(['get', 'post'], '/donate/return', [Front\DonationController::class, 'return'])
            ->name('donations.return')
            ->withoutMiddleware(VerifyCsrfToken::class);
    }

    Route::get('/blog', [Front\PostController::class, 'index'])->name('posts.index');
    Route::get('/blog/category', [Front\PostCategoryController::class, 'index'])->name('post_categories.index');
    Route::get('/blog/category/{post_category:slug}', [Front\PostCategoryController::class, 'show'])->name('post_categories.show');
    Route::get('/blog/{post:slug}', [Front\PostController::class, 'show'])->name('posts.show');

    Route::get('/people/{person:slug}', [Front\PersonController::class, 'show'])->name('people.show');

    Route::get('/forms/{form:slug}', [Front\FormController::class, 'show'])->name('forms.show');
    Route::post('/forms/{form:slug}', [Front\FormController::class, 'submit'])->name('forms.submit')->middleware('throttle:forms');

    Route::get('/search', Front\SearchController::class)->name('search')->middleware('throttle:search');

    Route::get('/', [Front\PageController::class, 'index'])->name('pages.index');
    Route::get('/{page:slug}', [Front\PageController::class, 'show'])->name('pages.show');
});
