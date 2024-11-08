<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class RegisterController extends Controller
{

	/**
	 * Display the registration view.
	 *
	 * @return \Inertia\Response
	 */
	public function create(): Response
	{
		return Inertia::render('Auth/Register');
	}

	/**
	 * Handle an incoming registration request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Inertia\Response
	 * @throws \Illuminate\Validation\ValidationException
	 */
	public function store(Request $request)
	{
		$fields = $request->validate([
			'name' => ['required', 'max:255', 'string' ],
			'email' => ['required', 'max:255', 'email', 'unique:users'],
			'password' => ['required', 'min:3', 'confirmed' ]
		]);
		$user = User::create($fields);
		Auth::login($user);
		// return to_route('/dashboard');
		return Inertia::render(
			'Dashboard'
		);
	}
}
