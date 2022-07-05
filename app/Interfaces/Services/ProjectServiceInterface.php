<?php

namespace App\Interfaces\Services;

interface ProjectServiceInterface
{
    public function store($request);
    public function getProjectById($projectId);
    public function updateById($request, $projectId);
    public function deleteProject($projectId);
}
