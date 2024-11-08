<?php

namespace App\Http\Controllers;

use App\Models\Faction;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;
use Inertia\Response;

class FactionController extends Controller
{



	/**
     * Display a listing of the factions.
	 * 
     */
    public function index()
    {
        $factions = Auth::user()->activeProject()->factions;

		return Inertia::render('Factions/Index', [
			'factions' => $factions
		]);
    }

	/**
     * Show the form for creating a new resource.
     */
    public function create()
    {
		$characters = Auth::user()->activeProject()->characters;
        $factions = Auth::user()->activeProject()->factions;

		return Inertia::render('Factions/Create', [
			'characters' => $characters,
			'factions' => $factions
		]);
    }

	/**
     * Display the specified faction.
     */
    public function show(Faction $faction)
    {
        $factions = Auth::user()->activeProject()->factions;
		$faction['members'] = $faction->members()->get();

		return Inertia::render('Factions/Show', [
			'factions' => $factions,
			'faction' => $faction
		]);
    }

	/**
     * Show the form for editing the specified resource.
     */
    public function edit(Faction $faction)
    {
		$characters = Auth::user()->activeProject()->characters;
        $factions = Auth::user()->activeProject()->factions;
		$faction['members'] = $faction->members()->get();

		return Inertia::render('Factions/Edit', [
			'characters' => $characters,
			'factions' => $factions,
			'faction' => $faction
		]);
    }





    protected $validationRules = [
		'image' => ['image', 'nullable', 'max:2048'],
		'name' => ['string', 'required'],
		'description' => ['string', 'nullable'],
		'members' => ['array'],
		'members.*.value' => ['exists:characters,id'],
		'members.*.role' => ['string', 'nullable']
	];

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request)
	{
		
		// Validate user request
		$validated = $request->validate($this->validationRules);

		$faction = new Faction($validated);
		$faction->project_id = Auth::user()->active_project;
		// $faction->fill($validated);
		$faction->save();

		foreach ($validated['characters'] as $character) {
			$faction->members()->attach($character['value']);
		}
		
		// Redirect user to new faction page
		return redirect("/factions/{$faction->slug}");
	}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Faction $faction)
    {
        // Validate user request
		$validated = $request->validate($this->validationRules);
		$faction->fill($validated);
		$faction->save();

		//	Syncronize faction members
		$formatForSync = [];
		foreach ( $validated['members'] as $character ) {
			$formatForSync[$character['value']] = [
				'role' => isset($character['role']) ? $character['role'] : null
			];
		}
		$faction->members()->sync($formatForSync);

		// Redirect user back to faction page
		return redirect("/factions/{$faction->slug}");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Faction $faction)
    {
        Session::flash('message', "<strong>{$faction->name}</strong> has been deleted.");
		$faction->delete();
		
		return redirect("/factions");
    }
}
