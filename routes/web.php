<?php

use App\Http\Controllers\CharacterController;
use App\Http\Controllers\CustomFieldController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FactionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//	Display the welcome page.
Route::get('/', [HomeController::class, 'index'])->name('welcome');

//	Import routes from auth.php
require __DIR__ . '/auth.php';

Route::middleware('auth')->group(function () {

	//	Display the dashboard page for logged in users.
	Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

	//	Display the user's settings page.
	Route::get('/user/profile',  [UserController::class,  'profile'])->name('profile');
	Route::get('/user/projects', [ProjectController::class, 'index'])->name('projects');
	Route::get('/user/settings', [UserController::class, 'settings'])->name('settings');

	//	Handle an incoming user update request.
	Route::patch('/users/{id}', [UserController::class, 'update'])->name('users.update');

	//	Activate a project for the current user.
	Route::patch('/user/projects/{id}/activate', [ProjectController::class, 'activate'])->name('projects.activate');

	Route::post('/custom_fields', [CustomFieldController::class, 'store'])->name('custom_field.store');
	Route::post('/custom_fields/{id}', [CustomFieldController::class, 'storeOptions'])->name('custom_field.store_options');

	//	Resources
	Route::resource('user/projects', ProjectController::class);
	Route::resource('characters', CharacterController::class);
	Route::resource('factions', FactionController::class);
	Route::resource('locations', LocationController::class);
	Route::resource('posts', PostController::class);
	
});
