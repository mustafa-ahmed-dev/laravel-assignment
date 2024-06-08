<?php

namespace App\Http\Controllers\Api;

use App\Models\Project;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;

use App\Http\Controllers\Controller;

use App\Http\Resources\ProjectCollection;
use App\Http\Resources\ProjectResource;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return [
            'data' => new ProjectCollection(Project::all())
        ];
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        $request_data = $request->validated();

        // Create the project
        $project = Project::create($request_data);

        $data = new ProjectResource($project);

        return [
            'data' => $data,
        ];
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return [
            'data' => new ProjectResource($project)
        ];
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $validated_data = $request->validated();

        $project->update($validated_data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();
    }
}
