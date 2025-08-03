<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'logo',
    ];
    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
    ];
    public function users()
    {
        return $this->hasMany(
            User::class,
            'company_id',
            'id'
        );
    }

    public function projects()
    {
        return $this->hasMany(
            Project::class,
            'company_id',
            'id'
        );
    }
}
