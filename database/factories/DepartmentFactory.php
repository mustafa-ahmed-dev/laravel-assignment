<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Department>
 */
class DepartmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'description' => $this->faker->realText(100),
            'created_at' => $this->faker->dateTimeThisDecade(),
            'manager_id' => NULL,
        ];
    }

    public function withManagerId($id)
    {
        return $this->state(function (array $attributes) use ($id) {
            return [
                'manager_id' => $id,
            ];
        });
    }
}
