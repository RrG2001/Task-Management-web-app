<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TasksResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'status' => $this->status,
            'value' => $this->title,
            'custom_id' => $this->custom_id,
            'description' => $this->description,
            'timeEstimation' => $this->time_estimation,
            'priority' => $this->priority,
            'reporter' => $this->reporter,
            'assignees' => $this->users ? UsersResources::collection($this->users) : null
        ];
    }
}
