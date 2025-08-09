<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    /**
     * Summary of boot
     * @return void
     * Edit Slug
     */
    public $timestamps = false;
    protected $fillable = [
        'name',
        'slug',
    ];
    protected $casts = [
        'name' => 'string',
        'slug' => 'string',
    ];
    public function profiles()
    {
        return $this->belongsToMany(
            Profile::class,
            'profile_tag',
            'tag_id',
            'profile_id',
            'id',
            'user_id',
        );
    }
}
