<?php

namespace App\Interfaces\Repositories;

interface ProjectRepositoryInterface
{
    public function getAll($projectId);
    public function getStatus($projectId, $statusId);
    public function getPriority($projectId, $priorityId);
    public function sortProjectUsers($userId);
}
