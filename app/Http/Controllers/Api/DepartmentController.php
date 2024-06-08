<?php

namespace App\Http\Controllers\Api;

use App\Models\Department;
use App\Http\Requests\StoreDepartmentRequest;
use App\Http\Requests\UpdateDepartmentRequest;

use App\Http\Controllers\Controller;

use App\Http\Resources\DepartmentCollection;
use App\Http\Resources\DepartmentResource;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return [
            'data' => new DepartmentCollection(Department::all()),
        ];
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDepartmentRequest $request)
    {
        $request_data = $request->validated();

        // Create the department
        $department = Department::create($request_data);

        $data = new DepartmentResource($department);

        return [
            'data' => $data,
        ];
    }

    /**
     * Display the specified resource.
     */
    public function show(Department $department)
    {
        return [
            'data' => new DepartmentResource($department),
        ];
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDepartmentRequest $request, Department $department)
    {
        $validated_data = $request->validated();

        $department->update($validated_data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        $department->delete();
    }
}
