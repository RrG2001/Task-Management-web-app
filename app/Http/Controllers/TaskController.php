<?php

namespace App\Http\Controllers;

use App\Http\Resources\TasksResources;
use App\Interfaces\Services\TaskServiceInterface;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    private $taskService;

    public function __construct(TaskServiceInterface $taskService)
    {
        $this->taskService = $taskService;
    }

    public function store(Request $request)
    {
        $task = $this->taskService->store($request);

        return $task
            ? new TasksResources($task)
            : response()->json(['data' => false]);
    }

    public function read($taskId)
    {
        return new TasksResources($this->taskService->getTaskById($taskId));
    }

    public function update(Request $request, $taskId)
    {
        return $this->taskService->updateById($request, $taskId);
    }

    public function delete($taskId)
    {
        $taskDeleted = $this->taskService->deleteTask($taskId);

        return $taskDeleted
            ? response()->json(['data' => true])
            : response()->json(['data' => false]);
    }

    public function getFilteredTasks(Request $request)
    {
        return $this->taskService->getFilteredTasks($request);
    }

    public function noAssignee(Request $request)
    {
        return $this->taskService->noAssignee($request);
    }
}
