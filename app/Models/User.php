<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Crypt;
use Laravel\Sanctum\HasApiTokens;
use App\Models\DatabaseNotification as CustomDatabaseNotification;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'company_id',

        'provider',
        'provider_id',
        'provider_token',
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'provider_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'lastActive'=> 'datetime',
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
            'user_id',
            'id'
        );
    }

    public function comments()
    {
        return $this->hasMany(
            Comment::class,
            'user_id',
            'id'
        );
    }

    public function profile()
    {
        return $this->hasOne(
            Profile::class,
            'user_id',
            'id'
        );
    }

    //method Mutator
    public function setProviderTokenAttribute($value)
    {
        return $this->attributes['provider_token'] = Crypt::encrypt($value);
    }

    //method Accessor
    public function getProviderTokenAttribute($value)
    {
        return Crypt::decrypt($value);
    }



    // استرجاع جميع الإشعارات
    public function notifications()
    {
        return $this->morphMany(CustomDatabaseNotification::class, 'notifiable')
            ->orderBy('created_at', 'desc');
    }

    // استرجاع الإشعارات المقروءة
    public function readNotifications()
    {
        return $this->morphMany(CustomDatabaseNotification::class, 'notifiable')
            ->whereNotNull('read_at')
            ->orderBy('created_at', 'desc');
    }

    // استرجاع الإشعارات الغير مقروءة
    public function unreadNotifications()
    {
        return $this->morphMany(CustomDatabaseNotification::class, 'notifiable')
            ->whereNull('read_at')
            ->orderBy('created_at', 'desc');
    }

    public function isOnline(){
        return $this->lastActive && $this->lastActive->gt(now()->subMinutes(2));
    }
}
