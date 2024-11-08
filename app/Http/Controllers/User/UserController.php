<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class UserController extends Controller
{

	/**
	 * Display the user settings page.
	 *
	 * @return \Inertia\Response
	 */
  public function profile(User $user): Response
	{
		return Inertia::render('User/Profile');
	}

	public function settings(User $user): Response
	{
		return Inertia::render('User/Settings');
	}

	/**
	 * Handle an incoming user update request.
	 *
	 * @return \Inertia\Response
	 */
	public function update(User $user, Request $request): RedirectResponse
	{
		$request->validate([
			'avatar' => ['image', 'nullable', 'max:2048'],
			'name' => ['required'],
			'email' => ['required']
		]);

		$user = Auth::user();
		$user->name = $request->input('name');
		$user->email = $request->input('email');

		if ( $request->avatar ) {
			$imageName = 'avatar_'.$request->input('email').'_'.time().'.'.$request->avatar->extension();
			$path = $request->avatar->storeAs('avatars', $imageName, 'public');
			$user->avatar = "/storage/{$path}";
		}

		$user->update();

		return back()->with('message', "<strong>{$user->name}</strong> has been updated.");
		// return redirect('/settings');
	}

}