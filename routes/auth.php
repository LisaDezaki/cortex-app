<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\RegisterController;

//	Guest Routes

Route::middleware(
	'guest'
)->group(
	function () {
	
	/**
	 * Display the registration view.
	 */
	Route::get(
		'/register',
		[RegisterController::class, 'create']
	)->name('register');

	/**
	 * Handle an incoming registration request.
	 */
	Route::post(
		'/register',
		[RegisterController::class, 'store']
	);

	/**
	 * Display the login view.
	 */
	Route::get(
		'/login',
		[AuthController::class, 'create']
	)->name('login');

	/**
	 * Handle an incoming authentication request.
	 */
	Route::post(
		'/login',
		[AuthController::class, 'store']
	);

	// Route::get(
	// 	'forgot-password',
	// 	[PasswordResetLinkController::class, 'create']
	// )->name('password.request');

	// Route::post(
	// 	'forgot-password',
	// 	[PasswordResetLinkController::class, 'store']
	// )->name('password.email');

	// Route::get(
	// 	'reset-password/{token}',
	// 	[NewPasswordController::class, 'create']
	// )->name('password.reset');

	// Route::post(
	// 	'reset-password',
	// 	[NewPasswordController::class, 'store']
	// )->name('password.update');

});

//	Auth Routes

Route::middleware('auth')->group(function () {

	/**
	 * Destroy an authenticated session.
	 */
	Route::post(
		'/logout',
		[AuthController::class, 'destroy']
	)->name('logout');

	// Route::get(
	// 	'verify-email',
	// 	[EmailVerificationPromptController::class, '__invoke']
	// )->name('verification.notice');

	// Route::get(
	// 	'verify-email/{id}/{hash}',
	// 	[VerifyEmailController::class, '__invoke']
	// )->middleware(
	// 	['signed', 'throttle:6,1']
	// )->name('verification.verify');

	// Route::post(
	// 	'email/verification-notification',
	// 	[EmailVerificationNotificationController::class, 'store']
	// )->middleware(
	// 	'throttle:6,1'
	// )->name('verification.send');

	// Route::get(
	// 	'confirm-password',
	// 	[ConfirmablePasswordController::class, 'show']
	// )->name('password.confirm');

	// Route::post(
	// 	'confirm-password',
	// 	[ConfirmablePasswordController::class, 'store']
	// );

	// Route::post(
	// 	'logout',
	// 	[AuthenticatedSessionController::class, 'destroy']
	// 	)->name('logout');

});