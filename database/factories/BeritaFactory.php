<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Berita>
 */
class BeritaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => fake()->uuid(),
            'user_id' => '',
            'category_berita_id' => fake()->randomElement(['0bf9b85a-346f-408e-bc58-af1fae321741', '4d254f12-9668-4a58-a59c-c0cb72df25a5', '9762e232-cfc1-4a44-9f9c-633bc75d9b8f']),
            'photo' => '',
            'slug' => fake()->slug(3, false),
            'title' => fake()->sentence(),
            'body' => fake()->paragraph(),
            'created_by' => '',
            'updated_by' => '',
            'deleted_by' => '',
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null,
            'status' => fake() ->randomElement([0,1]),
        ];
    }
}
