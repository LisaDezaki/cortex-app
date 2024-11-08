<?php

namespace Database\Factories;

use App\Models\Location;
use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Character>
 */
class CharacterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
			return [
				'project_id' => Project::inRandomOrder()->first()->id,
				// 'species_id' => Species::inRandomOrder()->first()->id,
				'name' => fake()->firstName(),
				'alias' => fake()->lastName(),
				'description' => fake()->text(500),
				// 'role' => fake()->jobTitle(),
				// 'location_id_home' => Location::inRandomOrder()->first()->id,
				// 'location_id_work' => Location::inRandomOrder()->last()->id,
			];
    }
}
