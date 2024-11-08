<?php

namespace App\Http\Controllers;

use App\Models\Project;
use DebugBar\DebugBar;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;
use Inertia\Response;

class ProjectController extends Controller
{
	public function index(): Response
	{
		$projects = Auth::user()->projects()->get();
		return Inertia::render('Projects/Index', ['projects' => $projects]);
	}
	public function create(): Response
	{
		return Inertia::render('Projects/Create');
	}
	public function show(Project $project): Response
	{
		return Inertia::render('Projects/Show', ['project' => $project]);
	}
	public function edit(Project $project): Response
	{
		return Inertia::render('Projects/Edit', ['project' => $project]);
	}

	public function store(Request $request): RedirectResponse
	{

		$request->validate([
			'name' => ['required'],
			'description' => [],
			'image' => ['image', 'nullable', 'max:2048'],
		]);

		$project = new Project;

		// Handle image file storage
		if ( $request->image ) {

			$time = time();
			$ext = $request->image->extension();
			$imageName = "project_{$request->name}_{$time}.{$ext}";
			$path = $request->image->storeAs('project', $imageName, 'public');
			$project->image = "/storage/{$path}";
		}

		$project->user_id = Auth::user()->id;
		$project->name = $request->name;
		$project->description = $request->description;
		$project->save();

		return redirect("/user/projects/{$project->id}");
	}

	public function update(Project $project, Request $request): RedirectResponse
	{
		$request->validate([
			'name' => ['required'],
			'description' => [],
			'image' => ['image', 'nullable', 'max:2048'],
		]);

		$project = Project::find($project->id);

		// Handle image file storage
		if ( $request->image ) {

			$time = time();
			$ext = $request->image->extension();
			$imageName = "project_{$request->name}_{$time}.{$ext}";
			$path = $request->image->storeAs('project', $imageName, 'public');
			$project->image = "/storage/{$path}";
		}

		$project->name = $request->input('name');
		$project->description = $request->input('description');
		$project->update();
		
		return redirect("/user/projects/{$project->id}");
	}

	public function destroy(Project $project): RedirectResponse
	{
		Session::flash('message', "<strong>{$project->name}</strong> has been deleted.");
		$project->delete();
		return redirect('/user/projects');
	}

	public function activate(Project $project, Request $request): RedirectResponse
	{
		$user = Auth::user();
		$user->active_project = $request->active;
		$user->update();
		return redirect("/dashboard");
	}

}