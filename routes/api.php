<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\DepartmentController;
use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Api\ProjectController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::group(['namespace' => 'App\Http\Controllers\Api'], function () {
    Route::apiResource('departments', DepartmentController::class);

    Route::apiResource('employees', EmployeeController::class);

    Route::apiResource('projects', ProjectController::class);
});

Route::controller(EmployeeController::class)->group(function () {
    // average salary grouped by age decades report
    Route::get("/employees/reports/avg-salary-group-by-age-decades", "average_salary_grouped_by_age_decades");

    // Managers chain report
    Route::get("/employees/{id}/reports/managers-chain", "chain_managers");
});
