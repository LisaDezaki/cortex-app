<?php

namespace App\Http\Controllers;

use App\Models\Character;
use App\Models\Post;
use App\Models\Project;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;
use Inertia\Response;

class PostController extends Controller
{
	public function index(): Response
	{
		$active_project = Auth::user()->active_project;
		$count = [
			'characters' => Character::count(),
			'posts' => Post::count(),
			'projects' => Project::count(),
		];
		$posts = Post::orderBy('id', 'desc')->simplePaginate(10);
		return Inertia::render('Posts/Index', ['posts' => $posts]);
	}
	public function create(): Response
	{
		$posts = Post::orderBy('id', 'desc')->simplePaginate(10);
		return Inertia::render('Posts/Create', ['posts' => $posts]);
	}

	public function store(Request $request): RedirectResponse
	{
		$post = Post::create($request->validate([
			'title' => ['required'],
			'content' => []
		]));
		return to_route('posts.show', $post);
	}

	public function edit(Post $post): Response
	{
		return Inertia::render('Posts/Edit', ['post' => $post]);
	}

	public function update(Post $post, Request $request): RedirectResponse
	{
		$request->validate(['title' => ['required']]);
		$post->title = $request->input('title');
		$post->content = $request->input('content');
		$post->update();
		return back()->with('message', "<strong>{$post->title}</strong> has been updated.");
	}

	public function show(Post $post): Response
	{
		$posts = Post::orderBy('id', 'desc')->simplePaginate(10);
		return Inertia::render('Posts/Show', ['posts' => $posts, 'post' => $post]);
	}

	public function destroy(Post $post): RedirectResponse
	{
		Session::flash('message', "<strong>{$post->title}</strong> has been deleted.");
		$post->delete();
		return to_route('home');
	}
}
