<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Staf>
 */
class StafFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // id	category_staf_id	nip	name	photo	created_by	updated_by	deleted_by	deleted_at	created_at	updated_at	
        return [
            'id' => fake()->uuid(),
            'category_id' => fake()->randomElement(['d8a5edf8-0b02-48b4-b0f5-d2a997317d15', 'ee097ce4-5703-402f-8ab7-96469809ff41', '0636a631-52ae-3247-9f30-2513fdebf3ab']),
            'nip' => '',
            'name' => fake()->name(),
            'photo' => '',
            'created_by' => '',
            'updated_by' => '',
            'deleted_by' => '',
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null,
        ];
    }
}
