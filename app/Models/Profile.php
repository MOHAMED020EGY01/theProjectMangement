<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

class Profile extends Model
{
    use HasFactory;
    protected $table = 'profiles';
    protected $primaryKey = 'user_id';
    public $incrementing = false;
    protected $fillable = [
        'user_id',
        'name',
        'phone',
        'address',
        'city',
        'state',
        'zip',
        'country',
        'image',
    ];
    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tags(){
        return $this->belongsToMany(
            Tag::class,
            'profile_tag',
            'profile_id',
            'tag_id',
            'user_id',
            'id',
        );
    }
    // Accessor image_profile
    public function getImageProfileAttribute(){
        return $this->image ? asset('storage/' . $this->image) : asset('defaultImage/profile/default.jpg');
    }




}
