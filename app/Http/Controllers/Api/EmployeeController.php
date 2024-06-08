<?php

namespace App\Http\Controllers\Api;

use App\Models\Employee;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;

use App\Http\Controllers\Controller;
use App\Http\Resources\EmployeeAverageSalaryCollection;
use App\Http\Resources\EmployeeCollection;
use App\Http\Resources\EmployeeResource;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return [
            'data' => new EmployeeCollection(Employee::all())
        ];
    }

    /**
     * Display the average salaries grouped by decades
     */
    public function average_salary_grouped_by_age_decades()
    {
        $data = Employee::averageSalaryGroupedByAgeDecades();

        return [
            'data' => new EmployeeAverageSalaryCollection($data)
        ];
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmployeeRequest $request)
    {
        $request_data = $request->validated();

        // Create the employee
        $employee = Employee::create($request_data);

        $data = new EmployeeResource($employee);

        return [
            'data' => $data,
        ];
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        return [
            'data' => new EmployeeResource($employee)
        ];
    }

    /**
     * Display the specified employee's managers chain
     */
    public function chain_managers($id)
    {
        $data = Employee::chain_managers($id);

        return [
            'data' => array_map(function ($manager) {
                return $manager->full_name;
            }, $data)
        ];
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        $validated_data = $request->validated();

        $employee->update($validated_data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();
    }
}
