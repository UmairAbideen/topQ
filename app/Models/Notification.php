<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [

        'subject',
        'link',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden =
        [
            // 'password',
            // 'remember_token',
        ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts =
        [
            // 'email_verified_at' => 'datetime',
            // 'password' => 'hashed',
        ];
}
