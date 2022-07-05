<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProjectsResources;
use App\Interfaces\Services\ProjectServiceInterface;
use App\Models\Task;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Project;

class ProjectController extends Controller
{

    private $projectService;

    public function __construct(ProjectServiceInterface $projectService)
    {
        $this->projectService = $projectService;
    }

    public function store(Request $request)
    {
        return $this->projectService->store($request);
    }

    public function read($projectId)
    {
        return new ProjectsResources($this->projectService->getProjectById($projectId));
    }

    public function update(Request $request, $projectId)
    {
        return $this->projectService->updateById($request, $projectId);
    }

    public function delete($projectId)
    {
        $projectDeleted = $this->projectService->deleteProject($projectId);

        return $projectDeleted
            ? response()->json(['data'=>true])
            : response()->json(['data'=>false]);
        }
}
