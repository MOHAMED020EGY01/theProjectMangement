<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'status',
        'project_id',
        'user_id',
        'due_date',
    ];
    const STATUS = [
        'pending' => 'Pending',
        'in_progress' => 'In Progress',
        'completed' => 'Completed',
    ];
    protected $casts = [
        'due_date' => 'datetime:Y-m-d',
    ];


    public function project()
    {
        return $this->belongsTo(
            Project::class,
            'project_id',
            'id'
        );
    }

    public function user()
    {
        return $this->belongsTo(
            User::class,
            'user_id',
            'id'
        );
    }

    public function comments()
    {
        return $this->hasMany(
            Comment::class,
            'task_id',
            'id'
        );
    }
}
