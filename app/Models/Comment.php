<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Comment extends Model
{
    use HasFactory;
    protected static function boot()
    {
        parent::boot();
    
        static::creating(function ($model) {
            $model->id = (string) Str::uuid();
        });
    }
    protected $keyType = 'string';
    public $incrementing = false;
    protected $primaryKey = 'id';
    protected $fillable = [
        'task_id',
        'user_id',
        'content',
    ];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
