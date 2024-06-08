<?php

namespace App\Models;

use App\Models\Department;
use App\Models\Project;

use Illuminate\Support\Facades\DB;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Employee extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['full_name', 'age', 'salary', 'date_of_employment', 'manager_id', 'department_id'];

    protected $casts = [
        'date_of_employment' => 'datetime',
        'age' => 'integer',
        'salary' => 'float',
    ];

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function manager(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'manager_id');
    }

    public function managesEmployees(): HasMany
    {
        return $this->hasMany(Employee::class, 'manager_id');
    }

    public function managesDepartment(): HasOne
    {
        return $this->hasOne(Department::class, 'manager_id');
    }

    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(Project::class, 'employee_project');
    }

    public static function chain_managers($id)
    {
        $query = "
            WITH RECURSIVE managers_chain AS (
                SELECT id, full_name, manager_id
                FROM employees
                WHERE id = ?

                UNION ALL

                SELECT e.id, e.full_name, e.manager_id
                FROM employees e
                INNER JOIN managers_chain mc ON e.id = mc.manager_id
            )
            SELECT full_name FROM managers_chain;
        ";

        return DB::select($query, [$id]);
    }

    public static function averageSalaryGroupedByAgeDecades()
    {
        return DB::select("
            WITH age_groups AS (
                SELECT
                    FLOOR(age / 10) * 10 AS start_age
                FROM
                    employees
            )
            SELECT
                CONCAT(start_age, '-', start_age + 9) AS age_range,
                AVG(salary) AS average_salary
            FROM
                employees
            JOIN
                age_groups ON FLOOR(employees.age / 10) * 10 = age_groups.start_age
            GROUP BY
                start_age
            ORDER BY
                start_age
        ");
    }
}
