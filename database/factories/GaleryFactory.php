<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Galery>
 */
class GaleryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // id	category_galery_id	type	title	photo	video	desc	created_by	updated_by	deleted_by	deleted_at	created_at	updated_at	

        $master = Master::where('type', 'galery')->get();
        
        return [
            'id' => fake()->uuid(),
            'category_id' => fake()->randomElement($master),
            'type' => fake()->randomElement(['photo', 'video']),
            'title' => fake()->paragraph(1, false),
            'photo' => fake()->imageUrl('360', '360', 'animals', true),
            'video' => 'https://www.youtube.com/embed/gkNRFuTs4B0?si=gQqZVqMeaHVpQC1S',
            'desc' => fake()->paragraph(2, false),
            'created_by' => '',
            'updated_by' => '',
            'deleted_by' => '',
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null,
        ];
    }
}
