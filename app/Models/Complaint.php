<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    protected $fillable = [
        'department',
        'complaint_no',
        'receipt_date',
        'customer',
        'detail',
        'category',
        'product',
        'batch',
        'serial',
        'expiry',
        'quantity',
        'capa_init',
        'capa_no',
        'capa_status',
        'associate_name',
        'associate_email',
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
