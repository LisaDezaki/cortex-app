<?php

namespace App\Http\Controllers;

use App\Models\CustomField;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CustomFieldController extends Controller
{



  	/**
	 * Handle an incoming character creation request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\RedirectResponse
	 */

	public function store(Request $request): RedirectResponse
	{

		// Validate user request
		$validated = $request->validate([
			'name' => 'required|string',
			'placeholder' => 'nullable|string',
			'table' => 'required|string|in:characters,factions,items,locations,quests',
			'type.value' => 'required|string|in:checkbox,radio,range,select,text'
		]);

		$customField = new CustomField($validated);
		$customField->project_id = Auth::user()->active_project;
		$customField->type = $validated['type']['value'];
		$customField->save();

		return redirect()->back();
	
	}

	public function storeOptions(CustomField $field, Request $request): RedirectResponse
	{

		$validated = $request->validate([
			'field.id' => 'exists:custom_fields,id',
			'project_id' => 'exists:projects,id',
			'values' => 'array',
			'values.*' => 'string'
		]);

		$options = [];
		foreach ($validated['values'] as $value) {
			$options[] = [
				'custom_field_id' => $validated['field']['id'],
				'value' => $value
			];
		}

		DB::table('custom_field_options')->insert($options);

		return redirect()->back();

	}



}
