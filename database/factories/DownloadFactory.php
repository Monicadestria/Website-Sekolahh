<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Download>
 */
class DownloadFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = ucwords($this->faker->words(rand(1, 5), true));
        $extension = $this->faker->randomElement(['pdf',  'doc', 'docx',  'xls', 'xlsx', 'ppt', 'pptx']);
        
        return [
            'id' => fake()->uuid(),
            'category_download_id' => fake()->randomElement(['88865keb-eb8c-40b9-90ff-f4ff394ce03s', 'a156474d-0308-49dd-b078-3fbae5897c2s', 'ebffa670-c8e1-4df8-9590-32a32e5792o7']),
            'title' => $title,
            'file' => $title . '.' . $extension,
            'desc' => fake()->paragraph(),
            'created_by' => '',
            'updated_by' => '',
            'deleted_by' => '',
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null,
        ];
    }
}
