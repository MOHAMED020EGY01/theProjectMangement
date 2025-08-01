<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
        'description',
        'deadline',
        'company_id',
        'user_id',
        'status',
    ];


    protected $casts = [
        'deadline' => 'datetime:Y-m-d',
    ];
    
    const STATUS = [
        'pending'=>'Pending',
        'in_progress'=>'In Progress',
        'completed'=>'Completed',
    ];

    public function company()
    {
        return $this->belongsTo(
            Company::class,
            'company_id',
            'id'
        );
    }

    public function tasks()
    {
        return $this->hasMany(
            Task::class,
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

    //method Accessor
    public function getProgressPercentageAttribute()
    {
        $totalTasks = $this->tasks()->count();
        if ($totalTasks == 0) return 0;

        $completedTasks = $this->tasks()->where('status', 'done')->count();
    return round(($completedTasks / $totalTasks) * 100);
}

}
