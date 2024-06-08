<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = $this->faker;
        $project_status = ['development', 'production'];

        $start_date = $faker->dateTimeThisDecade();
        $number_of_years = $faker->numberBetween(2, 4);
        $end_date = (clone $start_date)->modify("+{$number_of_years} years")->format('Y-m-d');

        return [
            'name' => $faker->word,
            'description' => $faker->realText(100),
            'start_date' => $start_date->format('Y-m-d'),
            'end_date' => $end_date,
            'status' => $faker->randomElement($project_status),
        ];
    }

    public function withProjectName($name)
    {
        return $this->state(function (array $attributes) use ($name) {
            return [
                'name' => $name,
            ];
        });
    }
}
