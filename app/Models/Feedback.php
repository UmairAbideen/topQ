<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $fillable = [
        'name',
        'designation',
        'organization',
        'email',

        'productquality_ins',
        'economicalsolution_ins',
        'overallservices_ins',
        'responsetocomplaints_ins',
        'remarks_ins',

        'responsetocomplaints_ts',
        'callattendedinscheduledtime_ts',
        'economicalsolution_ts',
        'overallperformance_ts',
        'remarks_ts',

        'productquality_iol',
        'economicalsolution_iol',
        'overallservices_iol',
        'responsetocomplaints_iol',
        'remarks_iol',

        'productquality_de',
        'economicalsolution_de',
        'overallservices_de',
        'responsetocomplaints_de',
        'remarks_de',
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
