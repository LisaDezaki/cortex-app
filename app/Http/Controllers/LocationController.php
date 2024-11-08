<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;
use Inertia\Response;

class LocationController extends Controller
{



    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $locations = Auth::user()->activeProject()->locations;

		return Inertia::render('Locations/Index', [
			'locations' => $locations
		]);
    }

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {
        $locations = Auth::user()->activeProject()->locations;

		return Inertia::render('Locations/Create', [
			'locations' => $locations
		]);
    }

	/**
     * Display the specified resource.
     */

    public function show(Location $location)
    {
        $locations = Auth::user()->activeProject()->locations;
		$location->employees = $location->employees()->get();
		$location->residents = $location->residents()->get();

		return Inertia::render('Locations/Show', [
			'locations' => $locations,
			'location' => $location
		]);
    }

	/**
     * Show the form for editing the specified resource.
     */

	 public function edit(Location $location)
	 {
		$locations = Auth::user()->activeProject()->locations;

		return Inertia::render('Locations/Edit', [
			'locations' => $locations,
			'location' => $location
		]);
	 }




	protected $validationRules = [
		'image' => ['image', 'nullable', 'max:2048'],
		'name' => ['string', 'required'],
		'description' => ['string', 'nullable']
	];

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        // Validate user request
		$validated = $request->validate($this->validationRules);

		$location = new Location($validated);
		$location->project_id = Auth::user()->active_project;
		$location->save();

		// Redirect user to new location page
		return redirect("/locations/{$location->slug}");
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, Location $location)
    {
        // Validate user request
		$validated = $request->validate($this->validationRules);
		$location->fill($validated);
		$location->save();

		// Redirect user back to location page
		return redirect("/locations/{$location->slug}");
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(Location $location)
    {
        //
    }
}
