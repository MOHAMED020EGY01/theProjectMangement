<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\DatabaseNotification as NotificationsDatabaseNotification;

class DatabaseNotification extends NotificationsDatabaseNotification
{
    use HasFactory,SoftDeletes;

    protected $casts = [
        'data' => 'array',
        'read_at' => 'datetime',
        'restore' => 'datetime',
    ];
}
