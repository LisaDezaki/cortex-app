<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Character;
use App\Models\Faction;
use App\Models\Location;
use App\Models\Post;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class DatabaseSeeder extends Seeder
{

	/**
	 * Seed the application's database.
	 */
	public function run(): void
	{



		$user = User::factory()->create([
				'name' => 'Administrator',
				'email' => 'admin@example.com',
		]);

		$tableton = Project::factory()->create([
			'user_id' => $user->id,
			'name' => 'Tableton'
		]);



		//	CHARACTERS

		$characters = [];
		$json = File::get(database_path('data/characters.json'));
		$json_characters = json_decode($json, true);
		foreach ($json_characters as $slug => $character) {
			$characters[$slug] = Character::factory()->create([
				'project_id' => $tableton->id,
				'name' => $character['name'],
				'slug'=> $slug,
				'alias' => $character['alias'],
				'description' => $character['desc'],
			]);
		}



		//	FACTIONS

		$factions = [];
		$json = File::get(database_path('data/factions.json'));
		$json_factions = json_decode($json, true);
		foreach ($json_factions as $slug => $faction) {
			$factions[$slug] = Faction::factory()->create([
				'project_id' => $tableton->id,
				'name' => $faction['name'],
				'slug'=> $slug,
				'description' => $faction['desc']
			]);
		}

		$characters['grenn']->factions()->attach($factions['cold-bloods']->id, ['role' => 'Boss']);
		$characters['bogdan']->factions()->attach($factions['cold-bloods']->id, ['role' => 'Bodyguard']);

		$characters['hamfast']->factions()->attach($factions['tavern-workers']->id, ['role' => 'Cook']);
		$characters['lafferty']->factions()->attach($factions['tavern-workers']->id, ['role' => 'Performer']);
		$characters['mae']->factions()->attach($factions['tavern-workers']->id, ['role' => 'Performer']);
		$characters['naomi']->factions()->attach($factions['tavern-workers']->id, ['role' => 'Performer']);
		$characters['rodrik']->factions()->attach($factions['tavern-workers']->id, ['role' => 'Bartender']);
		$characters['scratch']->factions()->attach($factions['tavern-workers']->id, ['role' => 'Performer']);
		$characters['willow']->factions()->attach($factions['tavern-workers']->id, ['role' => 'Barmaid']);

		$characters['bhezox']->factions()->attach($factions['dragon-council']->id, ['role' => 'Tech']);
		$characters['murhdox']->factions()->attach($factions['dragon-council']->id, ['role' => 'Media']);
		$characters['rhaegan']->factions()->attach($factions['dragon-council']->id, ['role' => 'Politics']);

		$characters['abigail']->factions()->attach($factions['pirates']->id, ['role' => 'Navigator']);
		$characters['bugbeard']->factions()->attach($factions['pirates']->id, ['role' => 'Captain']);
		$characters['duggan']->factions()->attach($factions['pirates']->id, ['role' => 'Heavy']);

		$characters['brundle']->factions()->attach($factions['insectoids']->id, ['role' => 'Gunner']);
		$characters['manto']->factions()->attach($factions['insectoids']->id, ['role' => 'Hunter']);
		$characters['mawloq']->factions()->attach($factions['insectoids']->id, ['role' => 'Heavy']);
		$characters['wikus']->factions()->attach($factions['insectoids']->id, ['role' => 'Berzerker']);

		$characters['kem']->factions()->attach($factions['teachers-union']->id, ['role' => 'Union Leader']);
		$characters['torva']->factions()->attach($factions['teachers-union']->id, ['role' => 'Union Member']);
		$characters['uma']->factions()->attach($factions['teachers-union']->id, ['role' => 'Headmistress']);

		$characters['binksy']->factions()->attach($factions['students']->id, ['role' => 'Failing Student']);
		$characters['nocturna']->factions()->attach($factions['students']->id, ['role' => 'Struggling Student']);
		$characters['stark']->factions()->attach($factions['students']->id, ['role' => 'Scholarship Student']);
		$characters['thalassa']->factions()->attach($factions['students']->id, ['role' => 'Student Body President']);
		
		$characters['ovina']->factions()->attach($factions['hikers']->id, ['role' => 'Sherpa']);
		$characters['perd']->factions()->attach($factions['hikers']->id, ['role' => 'Tourist']);



		//	LOCATIONS

		$locations = [];
		$json = File::get(database_path('data/locations.json'));
		$json_locations = json_decode($json, true);
		foreach ($json_locations as $slug => $location) {
			$locations[$slug] = Location::factory()->create([
				'project_id' => $tableton->id,
				'name' => $location['name'],
				'slug'=> $slug,
				'description' => $location['desc']
			]);
		}

		//	Home
		
		$characters['bhezox']->location_id_home  = $locations['tableton-council']->id;
		$characters['murhdox']->location_id_home = $locations['tableton-council']->id;
		$characters['rhaegan']->location_id_home = $locations['tableton-council']->id;

		$characters['grenn']->location_id_home   = $locations['tableton-tavern']->id;

		$characters['abigail']->location_id_home  = $locations['pirate-ship']->id;
		$characters['bugbeard']->location_id_home = $locations['pirate-ship']->id;
		$characters['duggan']->location_id_home   = $locations['pirate-ship']->id;

		$characters['gack']->location_id_home   = $locations['trailer-park']->id;

		//	Work

		$characters['bogdan']->location_id_work   = $locations['tableton-tavern']->id;
		$characters['hamfast']->location_id_work   = $locations['tableton-tavern']->id;
		$characters['lafferty']->location_id_work   = $locations['tableton-tavern']->id;
		$characters['mae']->location_id_work   = $locations['tableton-tavern']->id;
		$characters['naomi']->location_id_work   = $locations['tableton-tavern']->id;
		$characters['scratch']->location_id_work   = $locations['tableton-tavern']->id;
		$characters['willow']->location_id_work   = $locations['tableton-tavern']->id;

		$characters['kem']->location_id_work   = $locations['tableton-academy']->id;
		$characters['torva']->location_id_work   = $locations['tableton-academy']->id;
		$characters['uma']->location_id_work   = $locations['tableton-academy']->id;

		$characters['binksy']->location_id_work   = $locations['tableton-academy']->id;
		$characters['nocturna']->location_id_work   = $locations['tableton-academy']->id;
		$characters['stark']->location_id_work   = $locations['tableton-academy']->id;
		$characters['thalassa']->location_id_work   = $locations['tableton-academy']->id;

		$characters['ovina']->location_id_work   = $locations['red-mountains']->id;
		$characters['perd']->location_id_work   = $locations['red-mountains']->id;

		$characters['ferman']->location_id_work   = $locations['construction-site']->id;
		$characters['kass']->location_id_work   = $locations['construction-site']->id;

		$characters['laggard']->location_id_work   = $locations['tableton-precinct']->id;

		foreach ($characters as $slug => $character) { $character->save(); }








		$project2 = Project::factory()->create([
			'user_id' => 1,
			'name' => 'Deadworld'
		]);
		
	}
}
