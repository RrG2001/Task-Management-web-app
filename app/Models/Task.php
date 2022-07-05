<?php

namespace App\Models;

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'project_id',
        'custom_id',
        'title',
        'description',
        'status',
        'time_estimation',
        'priority',
        'reporter'
    ];

    public function project()
    {
        return $this->belongsTo(Project::class,'project_id','id');
    }
}
