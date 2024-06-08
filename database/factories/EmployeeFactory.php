<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Department;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'full_name' => $this->faker->name(),
            'age' => $this->faker->numberBetween(18, 40),
            'salary' => $this->faker->numberBetween(600_000, 1_200_000),
            'date_of_employment' => $this->faker->dateTimeThisDecade(),
            'manager_id' => NULL,
            'department_id' => NULL,
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

    public function withNoDepartmentId()
    {
        return $this->state(function (array $attributes) {
            return [
                'department_id' => NULL,
            ];
        });
    }
}
