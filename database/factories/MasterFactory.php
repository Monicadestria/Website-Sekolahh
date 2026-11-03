<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class MasterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user_id =  User::first('id');
        
        return [
            'id' => fake()->uuid(),
            'user_id' => $user_id,
            'name' => fake()->sentence(),
            'type' => fake()->randomElement(['Galeri', 'Berita', 'Staf', 'Unduh']),
            'created_by' => '',
            'updated_by' => '',
            'deleted_by' => '',
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null,
        ];
    }
}
