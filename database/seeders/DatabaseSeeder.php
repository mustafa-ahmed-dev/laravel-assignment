<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Project;
use App\Models\Department;
use App\Models\Employee;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();


        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);


        $projects = ['Fast-SIM', 'Fast-Serve', 'KPI'];

        foreach ($projects as $project) {
            Project::factory()->withProjectName($project)->count(1)->create();
        }

        // The first employee and the found, has no manager
        Employee::factory()->count(1)->withManagerId(NULL)->create();

        // Create departments
        $departments = Department::factory()->count(5)->create();

        // The managers that managed directly by the founder
        $employeeId = 2;
        // Create managers for each department
        $departments->each(function ($department) use (&$employeeId) {
            // Create a manager for the department
            Employee::factory()->count(1)->withManagerId(1)->create(['department_id' => $department->id]);
            // Update the department's manager ID
            $department->update(['manager_id' => $employeeId]);

            // Create descendant employees for the manager
            Employee::factory()->count(random_int(5, 10))->create([
                'manager_id' => $employeeId,
                'department_id' => $department->id,
            ]);

            $employeeId++;
        });
    }
}
