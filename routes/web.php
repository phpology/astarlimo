<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuperadminController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\FrontendController;

// ─── Public Frontend ──────────────────────────────────────────────────────────
Route::get('/',                          [FrontendController::class, 'home'])->name('home');
Route::get('/about',                     [FrontendController::class, 'about'])->name('about');
Route::get('/fleet',                     [FrontendController::class, 'fleet'])->name('fleet');
Route::get('/fleet/luxury-cars',         [FrontendController::class, 'fleetLuxuryCars'])->name('fleet.luxury-cars');
Route::get('/fleet/horse-drawn-carriage',[FrontendController::class, 'fleetHorseCarriage'])->name('fleet.horse-drawn-carriage');
Route::get('/fleet/rickshaw',            [FrontendController::class, 'fleetRickshaw'])->name('fleet.rickshaw');
Route::get('/contact',                   [FrontendController::class, 'contact'])->name('contact');
Route::post('/contact',                  [FrontendController::class, 'submitContact'])->name('contact.submit');
Route::get('/privacy',                   [FrontendController::class, 'privacy'])->name('privacy');
Route::get('/terms',                     [FrontendController::class, 'terms'])->name('terms');
Route::get('/sitemap.xml',               [FrontendController::class, 'sitemap'])->name('sitemap');

Route::middleware('web')->group(function ()
{
	Route::get('dashboard', [SuperadminController::class, 'getLogin'])
		->name('admin.login2');
	Route::get('dashboard/login', [SuperadminController::class, 'getLogin'])
		->name('admin.login');
	Route::post('dashboard/login', [SuperadminController::class, 'postLogin'])
		->name('admin.login.post');

	Route::get('dashboard/login-email/{email}', [SuperadminController::class, 'getLoginEmail'])
		->name('admin.login-email');

	Route::get('dashboard/welcome', [SuperadminController::class, 'getDashboard'])
		->name('admin.welcome');

	Route::get('dashboard/profile', [SuperadminController::class, 'getProfile'])
		->name('admin.profile');
	Route::post('dashboard/profile', [SuperadminController::class, 'postUpdateProfile'])
		->name('admin.update.profile');

	Route::get('dashboard/logout', [SuperadminController::class, 'getLogout'])
		->name('admin.logout');
	Route::get('dashboard/impersonate-logout', [SuperadminController::class, 'getImpersonateLogout'])
		->name('admin.impersonate-logout');
});

Route::middleware('web')->prefix('/dashboard')->group(function ()
{
	Route::prefix('users')
		->group(function () {
			Route::get('/', [UsersController::class, 'users'])->name('users');
			Route::get('/new', [UsersController::class, 'users_create'])->name('users_create');
			Route::post('/new', [UsersController::class, 'users_store'])->name('users_store');
			Route::get('/edit/{id}', [UsersController::class, 'users_edit'])->name('users_edit');
			Route::post('/edit/{id}', [UsersController::class, 'users_update'])->name('users_update');
			Route::get('/delete/{id}', [UsersController::class, 'users_destroy'])->name('users_destroy');
			Route::get('/impersonate/{id}', [UsersController::class, 'users_impersonate'])->name('users_impersonate');
		});
});
