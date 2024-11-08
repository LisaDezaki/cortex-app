<?php

namespace App\Http\Controllers;

use App\Models\Character;
use App\Models\Location;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;
use Inertia\Response;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class CharacterController extends Controller
{

	protected $validationRules = [
		'image' => ['image', 'nullable', 'max:2048'],
		'name' => ['string', 'required'],
		'alias' => ['string', 'nullable'],
		'description' => ['string', 'nullable'],
		'role' => ['string', 'nullable'],
		'location_id_home' => ['integer', 'nullable', 'exists:locations,id'],
		'location_id_work' => ['integer', 'nullable', 'exists:locations,id']
	];



	/**
     * Display a listing of the characters.
     *
	 * @return \Inertia\Response
	 */

	public function index(): Response
	{
		$characters = Auth::user()->activeProject()->characters;

		return Inertia::render('Characters/Index', [
			'characters' => $characters
		]);
	}



	/**
	 * Display the character creation view.
	 *
	 * @return \Inertia\Response
	 */

	public function create(): Response
	{
		$characters = Auth::user()->activeProject()->characters;
		$locations  = Auth::user()->activeProject()->locations;

		return Inertia::render('Characters/Create', [
			'characters' => $characters,
			'locations'  => $locations
		]);
	}



	/**
	 * Display the individual character view.
	 *
	 * @return \Inertia\Response
	 */

	public function show(Character $character): Response
	{
		$characters = Auth::user()->activeProject()->characters;
		$character['factions'] = $character->factions()->get();
		$character['home'] = $character->home;
		$character['work'] = $character->work;
		
		return Inertia::render('Characters/Show', [
			'characters' => $characters,
			'character'  => $character
		]);
	}



	/**
	 * Display the character edit view.
	 *
	 * @param  \App\Models\Character  $character
	 * @return \Inertia\Response
	 */

	public function edit(Character $character): Response
	{
		$characters = Auth::user()->activeProject()->characters;
		$locations  = Auth::user()->activeProject()->locations;

		return Inertia::render('Characters/Edit', [
			'characters' => $characters,
			'character'  => $character,
			'locations'  => $locations
		]);
	}



	/**
	 * Handle an incoming character creation request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\RedirectResponse
	 */

	public function store(Request $request): RedirectResponse
	{

		// Validate user request
		$request->validate($this->validationRules);

		// Handle image file storage
		if ( $request->image ) {
			$slug = SlugService::createSlug(Character::class, 'slug', $request->name);
			$imageName = $slug.'_'.time().'.'.$request->image->extension();
			$request->image->storeAs('characters', $imageName, 'public');
		}
		
		$character = new Character();
		// Save new character
		$character->project_id = Auth::user()->active_project;
		$character->name = $request->name;
		$character->alias = $request->alias;
		$character->description = $request->description;
		$character->role = $request->role;
		$character->home = $request->home;
		$character->work = $request->work;
		if ( $request->image ) {
			$character->image = '/storage/characters/'.$imageName;
		}
		$character->save();
		
		// Redirect user to new character page
		return redirect("/characters/{$character->slug}");
	}



	/**
	 * Handle an incoming character update request.
	 *
	 * @param  \App\Models\Character  $character
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\RedirectResponse
	 */

	public function update(Character $character, Request $request): RedirectResponse
	{

		//	Recapture IDs from Select inputs
		$request->merge([
			'location_id_home' => $request->home['value'] ?? null,
			'location_id_work' => $request->work['value'] ?? null,
		]);

		//	Validate user request
		$validated = $request->validate($this->validationRules);

		//	Add form data to $character instance
		$character->fill($validated);

		// Handle image file storage
		// TODO: remove previous image
		if ( $request->image ) {
			$imageName = $character->slug.'_'.time().'.'.$request->image->extension();
			$path = $request->image->storeAs('characters', $imageName, 'public');
			$character->image = "/storage/{$path}";
		}

		//	Push $character instance changes to database
		$character->update();

		//	Redirect user back to character page
		return redirect("/characters/{$character->slug}");
	}



	/**
	 * Handle an incoming delete character request.
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */

	public function destroy(Character $character): RedirectResponse
	{
		Session::flash('message', "<strong>{$character->name}</strong> has been deleted.");
		$character->delete();
		
		return redirect("/characters");
	}



}