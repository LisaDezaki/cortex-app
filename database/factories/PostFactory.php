<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $content = fake()->realText(500) . "\n\n" . 
            fake()->realText(500) . "\n\n" .
            fake()->realText(500);
            
        return [
            'title' => fake()->sentence(),
            'content' => $content
        ];
    }
}
