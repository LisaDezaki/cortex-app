<?php

namespace App\Http\Controllers;

use App\Models\Character;
use App\Models\Location;
use App\Models\Post;
use App\Models\Project;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
	public function index(): Response
	{
		$recent_characters = Character::latest()
			->take(10)
			->get()
			->map(function($char) {
				$char->created_at_human = Carbon::parse($char->created_at)->diffForHumans();
				return $char;
			})->toArray();

		$recent_locations = Location::latest()
			->take(10)
			->get()
			->map(function($loc) {
				$loc->created_at_human = Carbon::parse($loc->created_at)->diffForHumans();
				return $loc;
			})->toArray();

		return Inertia::render(
			'Dashboard',
			[
				'recent_characters'=> $recent_characters,
				'recent_locations'=> $recent_locations
				]
		);
	}
}



// $latestPosts = Post::latest()->take(10)->get()->map(function ($post) {
//     $post->created_at_human = Carbon::parse($post->created_at)->diffForHumans();
//     return $post;
// });