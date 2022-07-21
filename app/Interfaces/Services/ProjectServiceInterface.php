<?php

namespace App\Interfaces\Services;

interface ProjectServiceInterface
{
    public function getProjectById($projectId);
    public function updateById($request, $projectId);
    public function deleteProject($projectId);
    public function getAll($projectId);
    public function getStatus($projectId, $statusId);
    public function getPriority($project, $priorityId);
    public function createMultipleProjects($request);
}
